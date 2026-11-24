package luo.qlsu.autodaily.hook.config

import android.content.Context
import luo.qlsu.autodaily.hook.base.getSimpleName
import luo.qlsu.autodaily.hook.base.hostContext
import luo.qlsu.autodaily.hook.utils.QApplicationUtil
import luo.qlsu.autodaily.store.Kv
import java.io.File
import java.util.concurrent.ConcurrentHashMap

/**
 * AutoDaily 的三层配置存储：
 *  - classCache : 抗混淆类名缓存（按宿主 versionCode 分桶）
 *  - xaConfig   : 全局开关与内置配置密文
 *  - accountConfig : 每个 QQ 号独立的任务开关 / 变量 / 执行状态
 *
 * 原版是 MMKV + libxa_native.so，这里改成 SharedPreferences（MODE_MULTI_PROCESS），
 * 密文解密逻辑改成纯 Kotlin（见 luo.qlsu.autodaily.task.util.XaConfCrypto）。
 */
object Config {

    var isInit = false
        private set

    /** 备份/恢复用的目录（原实现叫 mmkvDir，保留同名以兼容 FileUtil）。 */
    val storeDir: File by lazy {
        val dir = File(hostContext.filesDir, "qlsu_ad")
        if (dir.isFile) dir.delete()
        if (!dir.exists()) dir.mkdirs()
        dir
    }

    @Suppress("unused")
    val mmkvDir: File get() = storeDir

    fun init() {
        isInit = true
    }

    private fun prefs(name: String) =
        hostContext.getSharedPreferences("QLsuAD_$name", Context.MODE_MULTI_PROCESS)

    val classCache by lazy { ConfProxy(Kv(prefs("Hooks"))) }

    val xaConfig by lazy { ConfProxy(Kv(prefs("Config"))) }

    private val confProxyMap = ConcurrentHashMap<Long, ConfProxy>(5)

    val accountConfig: ConfProxy
        get() {
            val uin = runCatching { QApplicationUtil.currentUin }.getOrDefault(0L)
            return confProxyMap[uin] ?: let {
                val currentConf = ConfProxy(Kv(prefs("Settings-$uin")))
                confProxyMap[uin] = currentConf
                currentConf
            }
        }

    private val obfuscate = mapOf(
        "Lcom/tencent/mobileqq/activity/ChatActivityFacade;" to setOf(
            "^reSendEmo",
        ),
        "Lcooperation/qzone/PlatformInfor;" to setOf(
            "^52b7f2$",
            "^qimei",
        ),
        "Lcom/tencent/mobileqq/service/MobileQQServiceBase;" to setOf(
            "^req_pb_protocol_flag$", "^MobileQQServiceBase$"
        ),
        "Lcom/tencent/qqnt/ntrelation/friendsinfo/bean/NTFriendSimpleInfo;" to setOf(
            "^NTFriendSimpleInfo uin"
        ),
        "Lcom/tencent/mobileqq/setting/main/NewSettingConfigProvider;" to setOf(
            "140134.140135", "功能", "隐私"
        ),
        "Lcom/tencent/mobileqq/setting/processor/SimpleItemProcessor;" to setOf(
            "SimpleItemProcessor"
        ),
        "Lcom/tencent/mobileqq/startup/task/KernelInitTask;" to setOf(
            "Uid is null, wait for complete"
        ),
        "Lcom/qzone/reborn/intimate/part/QZoneIntimateSpaceCoverPart;" to setOf(
            "QZoneIntimateSpaceCoverPartcheckIn"
        ),
        "Lcom/qzone/reborn/intimate/viewmodel/QZIntimateCheckInViewModel;" to setOf(
            "QZIntimateCheckInViewModel", "[doCheckInRequest] space id is "
        )
    )

    const val hooksVersion = 2

    val confuseInfo = mutableMapOf<String, Set<String>>().apply {
        obfuscate.forEach { (k, v) ->
            put(getSimpleName(k), v)
        }
    }

    fun clearAllConf() {
        classCache.clearAll()
        xaConfig.clearAll()
        accountConfig.clearAll()
        storeDir.deleteRecursively()
    }
}
