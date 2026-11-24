package luo.qlsu.autodaily.hook.function.base

import luo.qlsu.autodaily.utils.LogUtil

/**
 * 所有 AutoDaily 功能的基类。
 *
 * 注意：初始化失败只在日志里记录，不弹 Toast / 通知。
 * 之前的实现会对每个 Manager 各弹一次「初始化功能失败」，启动时看起来像“一大堆错误”，
 * 而且大多数只是当前 QQ 版本还没登录 / AppRuntime 未就绪导致的临时失败。
 */
abstract class BaseFunction(
    val TAG: String
) {
    abstract fun init()

    val isInit by lazy {
        try {
            init()
            LogUtil.i("function [$TAG] is initialize success.$this")
            true
        } catch (e: Exception) {
            LogUtil.e(e, "function [$TAG] is initialize fail. ${e.message}")
            false
        }
    }
}
