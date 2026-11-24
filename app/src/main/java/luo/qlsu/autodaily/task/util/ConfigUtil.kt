package luo.qlsu.autodaily.task.util

import cn.hutool.core.util.ReUtil
import com.charleskorn.kaml.Yaml
import com.charleskorn.kaml.YamlConfiguration
import luo.qlsu.BuildConfig
import luo.qlsu.autodaily.hook.base.hostContext
import luo.qlsu.autodaily.hook.base.moduleClassLoader
import luo.qlsu.common.ModuleLoader
import luo.qlsu.autodaily.hook.config.Config.xaConfig
import luo.qlsu.autodaily.hook.utils.ToastUtil
import luo.qlsu.autodaily.task.cron.pattent.CronPattern
import luo.qlsu.autodaily.task.cron.pattent.CronPatternUtil
import luo.qlsu.autodaily.task.model.MetaInfo
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.model.TaskProperties
import luo.qlsu.autodaily.ui.ConfUnit
import luo.qlsu.autodaily.ui.ConfUnit.lastFetchTime
import luo.qlsu.autodaily.ui.ConfUnit.metaInfoCache
import luo.qlsu.autodaily.ui.enable
import luo.qlsu.autodaily.ui.lastExecTime
import luo.qlsu.autodaily.ui.nextShouldExecTime
import luo.qlsu.autodaily.utils.FileEnum
import luo.qlsu.autodaily.utils.LogUtil
import luo.qlsu.autodaily.utils.RepoFileLoader
import luo.qlsu.autodaily.utils.TimeUtil
import luo.qlsu.autodaily.utils.getTextFromModuleAssets
import luo.qlsu.autodaily.utils.parse
import luo.qlsu.autodaily.utils.runRetry
import java.io.File
import java.util.Date
import java.util.TimeZone
import java.util.regex.Pattern

object ConfigUtil {

    /** 任务库里有模型未覆盖的字段，必须忽略未知键，否则整份配置解析失败。 */
    private val confYaml = Yaml(configuration = YamlConfiguration(strictMode = false))


    private val confDir = File(hostContext.filesDir, "xa_conf")

    private val MIN_APP_VERSION_REG = Pattern.compile("minAppVersion:\\s+(\\d+)")
    private val CONFIG_VERSION_REG = Pattern.compile("version:\\s+(\\d+)")

    private var _conf: TaskProperties? = null

    fun decryptXAConf(encConfBytes: ByteArray): ByteArray =
        XaConfCrypto.decrypt(String(encConfBytes, Charsets.UTF_8))

    fun getMd5Hex(value: String): String = XaConfCrypto.md5Hex(value)

    fun checkUpdate(showToast: Boolean): Boolean {
        val info = fetchMeta()
        info?.let {
            val currConfVer = loadSaveConf().version
            if (currConfVer < info.config.version) {
                if (BuildConfig.VERSION_CODE >= info.config.needAppVersion) {
                    updateConfig(showToast)
                }
            }
            if (BuildConfig.VERSION_CODE < info.app.versionCode) {
                if (showToast) {
                    ToastUtil.send("插件版本存在更新")
                }
                return true
            }
        }
        if (showToast) {
            ToastUtil.send("当前插件与配置均是最新版本")
        }
        return false
    }

    private fun updateConfig(showToast: Boolean): Boolean {
        try {
            val encRes = RepoFileLoader.load(FileEnum.CONF) ?: return false
            val res = decodeConfStr(encRes) ?: run {
                LogUtil.w("配置文件获取失败")
                return false
            }
            val minAppVersion = ReUtil.getGroup1(MIN_APP_VERSION_REG, res)?.toInt() ?: 0
            val confVersion = ReUtil.getGroup1(CONFIG_VERSION_REG, res)?.toInt() ?: 0
            if (minAppVersion > BuildConfig.VERSION_CODE) {
                if (showToast) {
                    ToastUtil.send("插件版本号低于${minAppVersion}，无法使用v${confVersion}版本的配置", true)
                }
                LogUtil.i("插件版本号低于${minAppVersion}，无法使用v${confVersion}版本的配置")
                return false
            }
            if (confVersion <= loadSaveConf().version) {
                if (showToast) {
                    ToastUtil.send("当前配置已是最新，无需更新")
                }
                return false
            }
            saveConfFile(encRes, confVersion)
            ConfUnit.needShowUpdateLog = true
            ToastUtil.send("配置文件更新完毕，如有选项更新，请前往配置页面勾选")
            return true
        } catch (e: Exception) {
            LogUtil.e(e)
            ToastUtil.send("更新配置文件失败，详情请看日志")
            return false
        }
    }

    private fun decodeConfStr(encodeConfStr: String): String? {
        LogUtil.d("conf length -> ${encodeConfStr.length}")
        val res = decryptXAConf(encodeConfStr.toByteArray())
        if (res.isEmpty()) {
            LogUtil.w("解密配置文件失败，请检查模块是否为最新版本")
            return null
        }
        return String(res)
    }

    private fun saveConfFile(encConfStr: String, configVersion: Int): Boolean {
        xaConfig.putString("xa_conf", encConfStr)
        _conf = null
        return true
    }

    private fun getDefaultConf(): String = getTextFromModuleAssets("default_conf")

    /** 读取模块 APK 内的资源：先 ClassLoader，再直接读 zip，兼容不同注入框架。 */
    private fun readModuleAsset(name: String): String? {
        val entry = "assets/$name"
        runCatching {
            moduleClassLoader.getResourceAsStream(entry)?.use {
                return String(it.readBytes(), Charsets.UTF_8)
            }
        }
        return runCatching {
            java.util.zip.ZipFile(ModuleLoader.getMODULE_PATH()).use { zip ->
                zip.getEntry(entry)?.let { e ->
                    zip.getInputStream(e).use { String(it.readBytes(), Charsets.UTF_8) }
                }
            }
        }.getOrNull()
    }

    /** 内置明文任务库（不再依赖 RSA 解密，避免部分设备解密失败）。 */
    private fun getDefaultConfText(): String? =
        readModuleAsset("default_conf.yaml")?.takeIf { it.contains("taskGroups") }

    private fun parseConfText(text: String): TaskProperties? = runCatching {
        val version = readMinVersion(text)
        if (version > BuildConfig.VERSION_CODE) {
            LogUtil.i("任务库要求最低版本 $version，当前 ${BuildConfig.VERSION_CODE}")
            return null
        }
        confYaml.decodeFromString(TaskProperties.serializer(), text)
    }.onFailure { LogUtil.e(it, "解析任务配置失败") }.getOrNull()

    fun loadSaveConf(): TaskProperties {
        if (_conf != null) {
            return _conf as TaskProperties
        }
        val saved = loadConf()
        val defaultConf = getDefaultConfText()?.let { parseConfText(it) }
            ?: loadConf(getDefaultConf())
        defaultConf ?: run {
            LogUtil.w("内置任务库读取失败，本次进入没有任务可显示")
            return TaskProperties(0, 0, listOf(), listOf())
        }
        val conf = if (saved == null || saved.version < defaultConf.version) defaultConf else saved
        if (saved == null) {
            ConfUnit.needShowUpdateLog = true
        }
        _conf = conf
        return conf
    }

    private fun loadConf(): TaskProperties? {
        val encodeConfStr = xaConfig.getString("xa_conf")
        return encodeConfStr?.let { loadConf(it) }
    }

    private fun loadConf(encodeConfStr: String): TaskProperties? {
        return runRetry(3, 20) {
            decodeConfStr(encodeConfStr)?.let { decodeConfStr ->
                val version = readMinVersion(decodeConfStr)
                if (version > BuildConfig.VERSION_CODE) {
                    LogUtil.i("模块版本过低，无法加载配置。配置要求最低版本: $version，当前版本: ${BuildConfig.VERSION_CODE}")
                    return@let null
                }
                return@let confYaml.decodeFromString(TaskProperties.serializer(), decodeConfStr)
            }
        }
    }

    private fun readMinVersion(confStr: String): Int {
        val str = ReUtil.getGroup1(MIN_APP_VERSION_REG, confStr)
        return if (str.isNullOrEmpty()) 0 else str.toInt()
    }

    fun getCurrentExecTaskNum(): Int {
        var num = 0
        val conf = loadSaveConf()
        val nowStr = TimeUtil.getCNDate().format().substring(0, 10)
        conf.taskGroups.forEach { taskGroup ->
            taskGroup.tasks.forEach { task ->
                val time = task.lastExecTime ?: ""
                if (time.startsWith(nowStr)) {
                    num++
                }
            }
        }
        return num
    }

    fun fetchMeta(): MetaInfo? {
        val text: String? = RepoFileLoader.load(FileEnum.META)
        LogUtil.d("fetch meta -> $text")
        val meta = runCatching {
            text?.parse<MetaInfo>()
        }.onFailure {
            LogUtil.e(it, "解析meta失败：")
        }.getOrNull()
        metaInfoCache = meta
        lastFetchTime = System.currentTimeMillis()
        return meta
    }

    fun checkExecuteTask(task: Task): Boolean {
        // 只有手动添加到「定时任务」列表、且开关打开的任务才参与调度
        if (!luo.qlsu.autodaily.store.ScheduledTaskStore.isEnabled(task.id)) {
            return false
        }
        val lastExecTime = parseDate(task.lastExecTime)
        val now = TimeUtil.getCNDate()
        val nextShouldExecTime = task.nextShouldExecTime ?: run {
            val realCron = TaskUtil.getRealCron(task)
            val currDate = Date(TimeUtil.cnTimeMillis() + 1)
            val time = CronPatternUtil.nextDateAfter(
                TimeZone.getTimeZone("GMT+8"),
                CronPattern(realCron),
                currDate,
                true
            )!!
            task.nextShouldExecTime = Date(time.time - TimeUtil.offsetTime).format()
            Date(time.time + TimeUtil.offsetTime).format()
        }
        lastExecTime ?: run {
            if (task.nextShouldExecTime?.substring(0, 10) != now.format().substring(0, 10)) {
                return true
            }
        }
        if (nextShouldExecTime <= now.format()) {
            return true
        }
        return false
    }
}
