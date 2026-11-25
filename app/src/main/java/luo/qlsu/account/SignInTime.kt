package luo.qlsu.account

import android.content.Context
import android.content.Intent
import luo.qlsu.BuildConfig

/**
 * 签到总时间设置：模块 App 里选时间 → 广播给 QQ 进程 → QQ 进程存进自己的偏好并重建调度。
 * 默认每日 00:00。
 */
object SignInTime {

    const val ACTION = "luo.qlsu.action.SIGN_TIME"
    const val EXTRA_HOUR = "hour"
    const val EXTRA_MIN = "minute"

    private const val PREFS = "qlsu_sign_time"
    private const val KEY_HOUR = "hour"
    private const val KEY_MIN = "minute"

    fun hour(context: Context): Int =
        context.getSharedPreferences(PREFS, Context.MODE_PRIVATE).getInt(KEY_HOUR, 0)

    fun minute(context: Context): Int =
        context.getSharedPreferences(PREFS, Context.MODE_PRIVATE).getInt(KEY_MIN, 0)

    fun label(context: Context): String =
        "%02d:%02d".format(hour(context), minute(context))

    fun set(context: Context, hour: Int, minute: Int) {
        context.getSharedPreferences(PREFS, Context.MODE_PRIVATE).edit()
            .putInt(KEY_HOUR, hour)
            .putInt(KEY_MIN, minute)
            .apply()
        broadcast(context, hour, minute)
    }

    private fun broadcast(context: Context, hour: Int, minute: Int) {
        listOf("com.tencent.mobileqq", "com.tencent.tim").forEach { pkg ->
            runCatching {
                context.sendBroadcast(
                    Intent(ACTION).apply {
                        setPackage(pkg)
                        putExtra(EXTRA_HOUR, hour)
                        putExtra(EXTRA_MIN, minute)
                    }
                )
            }
        }
    }
}
