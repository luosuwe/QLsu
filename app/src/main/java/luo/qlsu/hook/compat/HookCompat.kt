package luo.qlsu.hook.compat

import luo.qlsu.utils.qq.HostInfo

/**
 * 与其他 QQ/TIM 模块共存。
 *
 * 多个模块 Hook 同一批方法（闪照、防撤回、菜单、复读等）时会互相覆盖：
 * Xposed 的 beforeHook 链按注册顺序执行，后注册的模块最后执行，其结果优先生效。
 * 所以这里不跳过任何功能，而是把 QLsu 的注册整体延后，让 QLsu 的 Hook 优先。
 */
object HookCompat {

    /** 延后注册时间，等其它模块先完成 Hook */
    const val HOOK_DELAY_MS = 900L

    /** 已知的其他 QQ 模块包名（仅用于日志） */
    private val OTHER_MODULES = listOf(
        "me.yxp.qfun",
        "com.one.qfun",
        "com.tencent.qfun",
        "io.github.qfun"
    )

    val installed: Boolean by lazy {
        OTHER_MODULES.any { pkg ->
            runCatching {
                HostInfo.hostContext.packageManager.getPackageInfo(pkg, 0)
                true
            }.getOrDefault(false)
        }
    }

    fun logPriority() {
        android.util.Log.i(
            "QLsu",
            if (installed) "检测到其他 QQ 模块，QLsu 已延后注册，Hook 优先生效"
            else "未检测到其他 QQ 模块"
        )
    }
}
