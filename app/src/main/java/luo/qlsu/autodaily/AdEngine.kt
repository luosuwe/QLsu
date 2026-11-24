package luo.qlsu.autodaily

import kotlinx.coroutines.delay
import luo.qlsu.autodaily.hook.FromServiceMsgHook
import luo.qlsu.autodaily.hook.base.moduleLoadInit
import luo.qlsu.autodaily.hook.config.Config
import luo.qlsu.autodaily.hook.inject.ServletPool
import luo.qlsu.autodaily.hook.utils.QApplicationUtil
import luo.qlsu.autodaily.hook.utils.ToastUtil
import luo.qlsu.autodaily.store.ScheduledTaskStore
import luo.qlsu.autodaily.ui.lastExecTime
import luo.qlsu.autodaily.task.request.enum.ReqType
import luo.qlsu.autodaily.task.util.ConfigUtil
import luo.qlsu.autodaily.task.util.format
import luo.qlsu.autodaily.task.util.TaskUtil
import luo.qlsu.autodaily.utils.LogUtil
import luo.qlsu.autodaily.utils.TaskExecutor
import luo.qlsu.common.ModuleScope
import luo.qlsu.utils.net.HttpUtils
import luo.qlsu.utils.qq.HostInfo
import java.util.concurrent.atomic.AtomicBoolean

/**
 * AutoDaily 子系统入口（常驻，不提供总开关）。
 *
 * 启动流程尽量“安静”：任何一步失败都只写日志，不弹 Toast/通知。
 * 之前的实现会在启动时预热全部 Manager，每个失败都弹一次「初始化失败」，
 * 在 QQ 版本不完全匹配时会出现满屏错误提示。
 */
object AdEngine {

    @Volatile
    private var installed = false

    @Volatile
    var bootstrapDone = false
        private set

    private val servletInjected = AtomicBoolean(false)

    private const val WAIT_LIMIT_MS = 120_000L

    fun install() {
        if (HostInfo.processName != HostInfo.packageName) return
        if (installed) return
        installed = true
        startScheduler()
        ModuleScope.launchIO("AdHeartbeat") {
            while (true) {
                delay(15 * 60 * 1000L)
                runCatching { if (runtimeReady()) registerUser() }
            }
        }
        runCatching { Config.init() }
        runCatching { FromServiceMsgHook.install() }
            .onFailure { LogUtil.e(it, "安装 MSF 钩子失败") }
        ModuleScope.launchIO("AdBootstrap") { bootstrap() }
    }

    private fun runtimeReady(): Boolean = runCatching {
        val rt = QApplicationUtil.appRuntime
        rt.isLogin && rt.longAccountUin != 0L
    }.getOrDefault(false)

    private suspend fun bootstrap() {
        var waited = 0L
        while (waited < WAIT_LIMIT_MS && !runtimeReady()) {
            delay(500)
            waited += 500
        }

        if (runtimeReady()) {
            injectServletOnce()
            registerUser()
        } else {
            LogUtil.w("AppRuntime 尚未就绪，Servlet 延迟到账号切换时再注入")
        }

        runCatching { ConfigUtil.loadSaveConf() }
            .onFailure { LogUtil.e(it, "加载任务配置失败") }

        // TaskExecutor 的等待循环依赖这个标记
        moduleLoadInit = true

        bootstrapDone = true
        LogUtil.i(
            "AutoDaily 初始化完成: host=${HostInfo.packageName}(${HostInfo.versionName}), " +
                    "uin=${runCatching { QApplicationUtil.currentUin }.getOrNull()}, " +
                    "已添加定时任务=${runCatching { ScheduledTaskStore.list().size }.getOrDefault(0)}"
        )
    }

    /** QQ 切号/登录完成后由 MainHook 调用。 */
    fun onAccountChanged() {
        if (!installed) return
        ModuleScope.launchIO("AdAccountChanged") {
            var waited = 0L
            while (waited < 30_000L && !runtimeReady()) {
                delay(500)
                waited += 500
            }
            if (runtimeReady()) {
                injectServletOnce()
                registerUser()
            }
        }
    }

    /** 首次使用模块的 QQ 号自动在网页后台注册（默认密码 = QQ 号）。 */
    private suspend fun registerUser() {
        runCatching {
            val uin = luo.qlsu.autodaily.hook.utils.QApplicationUtil.currentUin
            if (uin != 0L) {
                HttpUtils.postSuspend(
                    "${HttpUtils.HOST}/api/heartbeat.php",
                    "uin=$uin&version=${luo.qlsu.BuildConfig.VERSION_NAME}"
                )
            }
        }.onFailure { LogUtil.d("后台注册失败: ${it.message}") }
    }
    private fun injectServletOnce() {
        if (!servletInjected.compareAndSet(false, true)) return
        runCatching { ServletPool.injectServlet() }
            .onFailure {
                servletInjected.set(false)
                LogUtil.e(it, "注入 Servlet 失败")
            }
    }

    fun runNow() {
        ModuleScope.launchIO("AdRunNow") { TaskExecutor.runTasks(true) }
    }

    /** 只跑一个手动添加的任务（含它的 relay/rear 依赖）。 */
    /** 任务库里的任务 id 可能和预设 id 有细微差异（空格/后缀），这里做容错匹配。 */
    fun resolveTask(taskId: String): luo.qlsu.autodaily.task.model.Task? {
        val conf = runCatching { ConfigUtil.loadSaveConf() }.getOrNull() ?: return null
        val all = conf.taskGroups.flatMap { it.tasks }
        return all.firstOrNull { it.id == taskId }
            ?: all.firstOrNull { it.id.trim() == taskId.trim() }
            ?: all.firstOrNull { it.id.contains(taskId) || taskId.contains(it.id) }
    }

    fun resolveTaskId(taskId: String): String = resolveTask(taskId)?.id ?: taskId
    /** 预设任务不依赖 XA 任务库，直接调 QQ 接口执行；返回 null 表示不是预设任务。 */
    private suspend fun runPresetDirect(taskId: String): Boolean? {
        if (!runtimeReady()) {
            var waited = 0L
            while (waited < 5_000L && !runtimeReady()) { delay(200); waited += 200 }
        }
        if (!runtimeReady()) return null
        if (!servletInjected.get()) injectServletOnce()
        var readyWait = 0L
        while (readyWait < 6_000L && !servletInjected.get()) { delay(200); readyWait += 200 }
        if (!servletInjected.get()) return null
        val prefixes = listOf(taskId, resolveTaskId(taskId)).distinct()
        fun read(name: String): String? = prefixes.firstNotNullOfOrNull {
            luo.qlsu.autodaily.hook.config.Config.accountConfig.getString("$it#${luo.qlsu.autodaily.task.util.Const.ENV_VARIABLE}#$name")
        }
        fun list(name: String) = read(name).orEmpty().split(",").map { it.trim() }.filter { it.isNotEmpty() }
        val message = read("message").orEmpty().ifBlank { "🔥" }
        val friends = list("friends")
        val groups = list("groups")
        return when (taskId) {
            "好友点赞" -> {
                if (friends.isEmpty()) return null
                friends.forEach { uin -> runCatching { repeat(2) { luo.qlsu.utils.qq.FriendTool.sendZan(uin, 10) } } }
                true
            }
            "好友续火花" -> {
                if (friends.isEmpty()) return null
                friends.forEach { uin -> runCatching { luo.qlsu.utils.qq.MsgTool.sendMsg(uin, message, 1) } }
                true
            }
            "群打卡" -> {
                if (groups.isEmpty()) return null
                groups.forEach { g -> runCatching { luo.qlsu.utils.qq.TroopTool.clockIn(g) } }
                true
            }
            "群组续火" -> {
                if (groups.isEmpty()) return null
                groups.forEach { g -> runCatching { luo.qlsu.utils.qq.MsgTool.sendMsg(g, message, 2) } }
                true
            }
            else -> null
        }
    }
    /** 完全按 XAutoDaily 的方式执行任务：TaskUtil.execute + 任务自带 xa:// 请求。 */
    private suspend fun executeXaTask(taskId: String): Boolean {
        if (!runtimeReady()) {
            var waited = 0L
            while (waited < 5_000L && !runtimeReady()) { delay(200); waited += 200 }
        }
        if (!runtimeReady()) return false
        if (!servletInjected.get()) injectServletOnce()
        var readyWait = 0L
        while (readyWait < 6_000L && !servletInjected.get()) { delay(200); readyWait += 200 }
        if (!servletInjected.get()) return false

        val conf = ConfigUtil.loadSaveConf()
        val task = resolveTask(taskId) ?: return false
        val group = conf.taskGroups.firstOrNull { g -> g.tasks.any { it.id == task.id } } ?: return false
        val relayMap = (group.preTasks + group.tasks).associateBy { it.id }
        val reqType = if (group.type == "func") ReqType.XA_FUNC else ReqType.HTTP
        return runCatching { TaskUtil.execute(reqType, task, relayMap, mutableMapOf()) }
            .onFailure { LogUtil.e(it, "XA 任务执行失败: ${task.id}") }
            .getOrDefault(false)
    }
    fun likeTarget(targetUin: Long) {
        ModuleScope.launchIO("AdLikeTarget") {
            if (!runtimeReady()) {
                var waited = 0L
                while (waited < 5_000L && !runtimeReady()) { delay(200); waited += 200 }
            }
            if (!runtimeReady()) return@launchIO
            if (!servletInjected.get()) injectServletOnce()
            var readyWait = 0L
            while (readyWait < 6_000L && !servletInjected.get()) { delay(200); readyWait += 200 }
            if (!servletInjected.get()) return@launchIO

            val direct = runCatching {
                luo.qlsu.autodaily.hook.function.proxy.FunctionPool.favoriteManager.syncFavorite(targetUin, 20)
            }.onFailure { LogUtil.e(it, "一键点赞失败") }.getOrDefault(false)
            if (direct) {
                LogUtil.i("一键点赞成功 target=$targetUin")
                runCatching { ToastUtil.send("点赞成功：+20") }
                return@launchIO
            }
            val xa = runCatching { executeXaTask("好友点赞") }.getOrDefault(false)
            LogUtil.i("一键点赞 target=$targetUin direct=$direct xa=$xa")
            runCatching { ToastUtil.send(if (xa) "点赞完成" else "点赞失败，请看日志") }
        }
    }
    /** 自带调度器：每 20 秒检查一次，到点用与「立即执行」相同的逻辑跑预设任务。 */
    private fun startScheduler() {
        ModuleScope.launchIO("AdScheduler") {
            while (true) {
                delay(20_000)
                runCatching {
                    val now = System.currentTimeMillis()
                    val tz = java.util.TimeZone.getTimeZone("GMT+8")
                    ScheduledTaskStore.list().filter { it.enabled }.forEach { st ->
                        val cron = st.cron.ifBlank { "0 0 8 * * *" }
                        val base = java.util.Date(
                            when {
                                st.lastRunAt > 0 -> st.lastRunAt
                                st.createdAt > 0 -> st.createdAt
                                else -> now
                            }
                        )
                        val next = luo.qlsu.autodaily.task.cron.pattent.CronPatternUtil.nextDateAfter(
                            tz, luo.qlsu.autodaily.task.cron.pattent.CronPattern(cron), base, true
                        ) ?: return@forEach
                        if (next.time <= now && st.lastRunAt < next.time) {
                            ScheduledTaskStore.markRun(st.id, next.time)
                            runCatching { ToastUtil.send("定时任务开始：${st.id}") }
                            LogUtil.i("定时执行 ${st.id}，计划时间 ${java.util.Date(next.time)}")
                            val directOk = runCatching { runPresetDirect(st.id) }.getOrNull()
                            val ok = directOk ?: runCatching { executeXaTask(st.id) }.getOrDefault(false)
                            runCatching {
                                ToastUtil.send(if (ok) "定时任务完成：${st.id}" else "定时任务失败：${st.id}")
                            }
                        }
                    }
                }.onFailure { LogUtil.e(it, "调度循环异常") }
            }
        }
    }
    fun runTask(taskId: String, onResult: ((Boolean, String) -> Unit)? = null) {
        ModuleScope.launchIO("AdRunTask") {
            fun finish(ok: Boolean, msg: String) {
                LogUtil.i("runTask $taskId -> $ok, $msg")
                onResult?.let { cb ->
                    android.os.Handler(android.os.Looper.getMainLooper()).post { cb(ok, msg) }
                }
            }

            val direct = runCatching { runPresetDirect(taskId) }.getOrElse {
                LogUtil.e(it, "预设任务本地执行失败: $taskId")
                null
            }
            if (direct != null) return@launchIO finish(direct, if (direct) "执行完成" else "没有可执行的对象")

            val conf = runCatching { ConfigUtil.loadSaveConf() }.getOrNull()
                ?: return@launchIO finish(false, "任务配置未加载")
            val task = resolveTask(taskId)
                ?: return@launchIO finish(false, "任务库中找不到任务（$taskId）")
            val group = conf.taskGroups.firstOrNull { g -> g.tasks.any { it.id == task.id } }
                ?: return@launchIO finish(false, "任务分组异常（${task.id}）")
            val relayMap = (group.preTasks + group.tasks).associateBy { it.id }
            val reqType = if (group.type == "func") ReqType.XA_FUNC else ReqType.HTTP

            if (!runtimeReady()) {
                var waited = 0L
                while (waited < 5_000L && !runtimeReady()) {
                    delay(200)
                    waited += 200
                }
            }
            if (!runtimeReady()) return@launchIO finish(false, "QQ 未登录，无法执行")

            if (!servletInjected.get()) injectServletOnce()
            var waited = 0L
            while (waited < 6_000L && !servletInjected.get()) {
                delay(200)
                waited += 200
            }
            if (!servletInjected.get()) return@launchIO finish(false, "服务未就绪，重启 QQ 后再试")

            val ok = runCatching {
                TaskUtil.execute(reqType, task, relayMap, mutableMapOf())
            }.onFailure {
                LogUtil.e(it, "单任务执行失败: $taskId")
            }.getOrDefault(false)
            finish(ok, if (ok) "执行完成" else "执行失败，详情见日志")
        }
    }
    fun updateConfig(showToast: Boolean = true): Boolean = ConfigUtil.checkUpdate(showToast)

    /** (手动添加数, 其中已启用, 今日已执行) */
    fun taskStat(): Triple<Int, Int, Int> {
        val scheduled = runCatching { ScheduledTaskStore.list() }.getOrDefault(emptyList())
        val conf = runCatching { ConfigUtil.loadSaveConf() }.getOrNull()
            ?: return Triple(scheduled.size, scheduled.count { it.enabled }, 0)
        val todayStr = runCatching {
            luo.qlsu.autodaily.utils.TimeUtil.getCNDate().format().substring(0, 10)
        }.getOrDefault("")
        var today = 0
        val ids = scheduled.map { it.id }.toSet()
        conf.taskGroups.forEach { group ->
            group.tasks.filter { it.id in ids }.forEach { task ->
                val last = runCatching { task.lastExecTime }.getOrNull() ?: ""
                if (todayStr.isNotEmpty() && last.startsWith(todayStr)) today++
            }
        }
        return Triple(scheduled.size, scheduled.count { it.enabled }, today)
    }

    val isReady: Boolean
        get() = bootstrapDone
}
