package luo.qlsu.hook.compat

import luo.qlsu.utils.log.LogUtils
import luo.qlsu.utils.qq.HostInfo

/**
 * 与 QFun（me.yxp.qfun）共存：QFun 也 Hook 了闪照、防撤回、菜单、复读等同一批方法，
 * 两边都改写返回值时会互相覆盖。检测到 QFun 已安装时，QLsu 主动让出这些重叠功能，
 * 由 QFun 单独生效，避免功能被抵消。
 */
object QfunCompat {

    private const val QFUN_PACKAGE = "me.yxp.qfun"

    /** QFun 功能关键词：命中即让出 */
    private val OVERLAP_KEYWORDS = listOf(
        "闪照", "防撤回", "撤回", "复读", "复读+1", "+1",
        "菜单", "群管", "点赞", "平板", "精确", "艾特", "表情回应",
        "续火", "打卡", "红包", "骰子", "猜拳"
    )

    val installed: Boolean by lazy {
        runCatching {
            HostInfo.hostContext.packageManager.getPackageInfo(QFUN_PACKAGE, 0)
            true
        }.getOrElse {
            runCatching {
                Class.forName("$QFUN_PACKAGE.BuildConfig", false, luo.qlsu.utils.reflect.ClassUtils.hostClassLoader)
                true
            }.getOrDefault(false)
        }
    }

    fun shouldYield(name: String): Boolean {
        if (!installed) return false
        return OVERLAP_KEYWORDS.any { name.contains(it, ignoreCase = true) }
    }

    fun logYield(name: String) {
        android.util.Log.i("QLsu", "检测到 QFun，QLsu 让出重叠功能：$name")
    }
}
