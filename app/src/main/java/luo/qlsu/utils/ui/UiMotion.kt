package luo.qlsu.utils.ui

import android.app.Activity
import android.content.Context
import android.os.Build

/**
 * 模块界面过渡动画开关。
 * 关闭后：页面进入 / 返回都不播放系统过渡动画（默认关闭）。
 */
object UiMotion {

    private const val PREFS = "qlsu_ui"
    private const val KEY_PAGE_ANIM = "page_anim"

    fun isEnabled(context: Context): Boolean =
        context.applicationContext.getSharedPreferences(PREFS, Context.MODE_PRIVATE)
            .getBoolean(KEY_PAGE_ANIM, false)

    fun setEnabled(context: Context, enabled: Boolean) {
        context.applicationContext.getSharedPreferences(PREFS, Context.MODE_PRIVATE)
            .edit().putBoolean(KEY_PAGE_ANIM, enabled).apply()
    }
}

object ActivityAnim {

    /** 关掉当前 Activity 的进入 / 退出过渡动画（含返回时的进入动画） */
    fun disable(activity: Activity) {
        runCatching {
            @Suppress("DEPRECATION")
            activity.overridePendingTransition(0, 0)
        }
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.UPSIDE_DOWN_CAKE) {
            runCatching {
                activity.overrideActivityTransition(Activity.OVERRIDE_TRANSITION_OPEN, 0, 0)
                activity.overrideActivityTransition(Activity.OVERRIDE_TRANSITION_CLOSE, 0, 0)
            }
        }
    }

    fun apply(activity: Activity) {
        if (!UiMotion.isEnabled(activity)) {
            disable(activity)
        }
    }
}
