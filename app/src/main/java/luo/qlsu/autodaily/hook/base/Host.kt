package luo.qlsu.autodaily.hook.base

import android.app.Application
import android.content.Context
import luo.qlsu.common.ModuleLoader
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.ClassUtils

/**
 * AutoDaily 子系统原本直接持有自己的全局变量（hostContext / hostClassLoader ...）。
 * 移植进 QLsu 后这些全局量全部改为读取 QLsu 的 HostInfo / ClassUtils，
 * 这样 AutoDaily 的 Manager、任务引擎代码可以保持原样。
 */

val hostContext: Context
    get() = HostInfo.hostContext

val hostApp: Application
    get() = HostInfo.hostContext.applicationContext as Application

val hostClassLoader: ClassLoader
    get() = ClassUtils.hostClassLoader

val hostPackageName: String
    get() = HostInfo.packageName

val hostProcessName: String
    get() = HostInfo.processName

val hostVersionName: String
    get() = HostInfo.versionName

val hostVersionCode: Long
    get() = HostInfo.versionCode

val hostAppName: String
    get() = HostInfo.hostName

/** QLsu 的宿主信息在 BaseApplicationImpl.onCreate 里一次性写入，到这里一定已经可用。 */
val hostInit: Boolean
    get() = HostInfo.packageName.isNotEmpty()

val moduleClassLoader: ClassLoader
    get() = ModuleLoader::class.java.classLoader!!

val modulePath: String
    get() = ModuleLoader.getMODULE_PATH()

val isInjectClassLoader: Boolean
    get() = true

@Volatile
var moduleLoadInit = false
