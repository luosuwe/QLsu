package luo.qlsu.autodaily.ui

import kotlinx.serialization.Serializable
import luo.qlsu.BuildConfig
import luo.qlsu.autodaily.hook.config.Config.accountConfig
import luo.qlsu.autodaily.hook.config.Config.xaConfig
import luo.qlsu.autodaily.task.model.MetaInfo
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.util.Const.BLOCK_UPDATE_ONE_DAY
import luo.qlsu.autodaily.task.util.Const.CRON_OVERRIDE
import luo.qlsu.autodaily.task.util.Const.BLOCK_UPDATE_VERSION
import luo.qlsu.autodaily.task.util.Const.DISABLE_DAMAGE_ENV
import luo.qlsu.autodaily.task.util.Const.ENABLE
import luo.qlsu.autodaily.task.util.Const.ENABLE_DEBUG_LOG
import luo.qlsu.autodaily.task.util.Const.ENABLE_TASK_EXCEPTION_NOTIFICATION
import luo.qlsu.autodaily.task.util.Const.ENABLE_TASK_NOTIFICATION
import luo.qlsu.autodaily.task.util.Const.ENV_VARIABLE
import luo.qlsu.autodaily.task.util.Const.GLOBAL_ENABLE
import luo.qlsu.autodaily.task.util.Const.LAST_EXEC_MSG
import luo.qlsu.autodaily.task.util.Const.LAST_EXEC_TIME
import luo.qlsu.autodaily.task.util.Const.LAST_FETCH_TIME
import luo.qlsu.autodaily.task.util.Const.LOG_TO_XPOSED
import luo.qlsu.autodaily.task.util.Const.LastModuleVersion
import luo.qlsu.autodaily.task.util.Const.META_INFO_CACHE
import luo.qlsu.autodaily.task.util.Const.NEED_SHOW_LOG
import luo.qlsu.autodaily.task.util.Const.NEXT_SHOULD_EXEC_TIME
import luo.qlsu.autodaily.task.util.Const.RETRY_COUNT
import luo.qlsu.autodaily.task.util.Const.SHOW_TASK_TOAST
import luo.qlsu.autodaily.task.util.Const.TASK_EXCEPTION_COUNT
import luo.qlsu.autodaily.task.util.Const.TASK_EXEC_STATUS
import luo.qlsu.autodaily.task.util.Const.USED_THREAD_POOL
import luo.qlsu.autodaily.utils.parse
import luo.qlsu.autodaily.utils.toJsonString

object ConfUnit {
    val needUpdate: Boolean get() {
        metaInfoCache?.let {
            if (BuildConfig.VERSION_CODE < it.app.versionCode) {
                return true
            }
        }
        return false
    }

    // -------------------------------------------------- //\
    var metaInfoCache: MetaInfo?
        get() {
            val str = xaConfig.getString(META_INFO_CACHE, "")
            return runCatching {
                if (str.isNotEmpty()) {
                    return str.parse()
                }
                return null
            }.getOrNull()
        }
        set(value) {
            xaConfig.putString(META_INFO_CACHE, value.toJsonString())
        }
    var lastModuleVersion: Int
        get() = xaConfig.getInt(LastModuleVersion, 0)
        set(value) = xaConfig.putInt(LastModuleVersion, value)
    var lastFetchTime: Long
        get() = xaConfig.getLong(LAST_FETCH_TIME, 0)
        set(value) = xaConfig.putLong(LAST_FETCH_TIME, value)
    var blockUpdateOneDay: String?
        get() = xaConfig.getString(BLOCK_UPDATE_ONE_DAY)
        set(value) = xaConfig.putString(BLOCK_UPDATE_ONE_DAY, value)
    var skipUpdateVersion: String?
        get() = xaConfig.getString(BLOCK_UPDATE_VERSION)
        set(value) = xaConfig.putString(BLOCK_UPDATE_VERSION, value)
    var needShowUpdateLog: Boolean
        get() = xaConfig.getBoolean(NEED_SHOW_LOG, false)
        set(value) = xaConfig.putBoolean(NEED_SHOW_LOG, value)
    var usedThreadPool: Boolean
        get() = xaConfig.getBoolean(USED_THREAD_POOL, true)
        set(value) = xaConfig.putBoolean(USED_THREAD_POOL, value)
    var showTaskToast: Boolean
        get() = xaConfig.getBoolean(SHOW_TASK_TOAST, true)
        set(value) = xaConfig.putBoolean(SHOW_TASK_TOAST, value)
    var enableTaskNotification: Boolean
        get() = xaConfig.getBoolean(ENABLE_TASK_NOTIFICATION, false)
        set(value) = xaConfig.putBoolean(ENABLE_TASK_NOTIFICATION, value)
    var enableTaskExceptionNotification: Boolean
        get() = xaConfig.getBoolean(ENABLE_TASK_EXCEPTION_NOTIFICATION, true)
        set(value) = xaConfig.putBoolean(ENABLE_TASK_EXCEPTION_NOTIFICATION, value)
    var logToXposed: Boolean
        get() = xaConfig.getBoolean(LOG_TO_XPOSED, false)
        set(value) = xaConfig.putBoolean(LOG_TO_XPOSED, value)
    var enableDebugLog: Boolean
        get() = xaConfig.getBoolean(ENABLE_DEBUG_LOG, false)
        set(value) = xaConfig.putBoolean(ENABLE_DEBUG_LOG, value)
    var disableDamageEnv: Boolean
        get() = xaConfig.getBoolean(DISABLE_DAMAGE_ENV, false)
        set(value) = xaConfig.putBoolean(DISABLE_DAMAGE_ENV, value)


}

// -------------------------------------------------- //
var Task.enable: Boolean
    get() = accountConfig.getBoolean("${this.id}#${ENABLE}", false)
    set(value) = accountConfig.putBoolean("${this.id}#${ENABLE}", value)

/** 用户为单个任务自定义的秒级 cron；为空则使用任务库里的默认值 */
var Task.cronOverride: String
    get() = accountConfig.getString("${this.id}#${CRON_OVERRIDE}") ?: ""
    set(value) {
        accountConfig.putString("${this.id}#${CRON_OVERRIDE}", value)
        this.nextShouldExecTime = null
    }

var Task.lastExecTime: String?
    get() = accountConfig.getString("${this.id}#${LAST_EXEC_TIME}")
    set(value) = accountConfig.putString("${this.id}#${LAST_EXEC_TIME}", value)

var Task.nextShouldExecTime: String?
    get() = accountConfig.getString("${this.id}#${NEXT_SHOULD_EXEC_TIME}")
    set(value) = accountConfig.putString("${this.id}#${NEXT_SHOULD_EXEC_TIME}", value)

var Task.lastExecMsg: String?
    get() = accountConfig.getString("${this.id}#${LAST_EXEC_MSG}")
    set(value) = accountConfig.putString("${this.id}#${LAST_EXEC_MSG}", value)

var Task.errInfo: TaskErrorInfo
    get() {
        val str = accountConfig.getString("${this.id}#${TASK_EXCEPTION_COUNT}") ?: ""
        return TaskErrorInfo.valueOf(str)
    }
    set(value) = accountConfig.putString("${this.id}#${TASK_EXCEPTION_COUNT}", value.toString())

var Task.taskExecStatus: TaskStatus
    get() {
        val str = accountConfig.getString("${this.id}#${TASK_EXEC_STATUS}") ?: ""
        return TaskStatus.valueOf(str)
    }
    set(value) = accountConfig.putString("${this.id}#${TASK_EXEC_STATUS}", value.toString())

var Task.retryCount: Int
    get() = accountConfig.getInt("${this.id}#${RETRY_COUNT}", 0)
    set(value) = accountConfig.putInt("${this.id}#${RETRY_COUNT}", value)

fun Task.reset() {
    this.lastExecTime = null
    this.lastExecMsg = null
    this.nextShouldExecTime = null
    this.errInfo = TaskErrorInfo()
    this.taskExecStatus = TaskStatus()
}

fun Task.getVariable(
    name: String, default: String
): String = accountConfig.getString("${this.id}#${ENV_VARIABLE}#${name}", default)

fun Task.setVariable(
    name: String, value: String?
) = accountConfig.putString("${this.id}#${ENV_VARIABLE}#${name}", value)

@Serializable
data class TaskStatus(
    var successCount: Int,
    var reqCount: Int,
    var lastExecDate: String,
) {
    constructor() : this(0, 0, "")

    override fun toString(): String {
        return "${successCount}|${reqCount}|${lastExecDate}"
    }

    companion object {
        fun valueOf(str: String): TaskStatus {
            runCatching {
                val arr = str.split("|")
                return TaskStatus(arr[0].toInt(), arr[1].toInt(), arr[2])
            }.getOrElse { return TaskStatus(0, 0, "") }
        }
    }
}

@Serializable
data class TaskErrorInfo(
    var dateStr: String = "",
    var count: Int = 0
) {

    override fun toString(): String {
        return "${dateStr}|${count}"
    }
    companion object {
        fun valueOf(str: String): TaskErrorInfo {
            runCatching {
                val split = str.split("|")
                return TaskErrorInfo(split[0], split[1].toInt())
            }.getOrElse { return TaskErrorInfo() }
        }
    }
}