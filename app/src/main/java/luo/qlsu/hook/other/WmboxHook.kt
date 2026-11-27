package luo.qlsu.hook.other

/**
 * 一个木函（com.One.WoodenLetter）会员解锁。
 * 走模块自己的 HookEngine，legacy / modern 都生效。
 */
object WmboxHook {

    const val PACKAGE = "com.One.WoodenLetter"

    private const val MEMBER_UTIL = "com.One.WoodenLetter.activitys.user.util.a"
    private const val PROFILE = "cn.woobx.databinding.model.AccountDataModel\$AccountData\$Profile"

    private val installing = java.util.concurrent.atomic.AtomicBoolean(false)

    fun install(cl: ClassLoader) {
        if (!installing.compareAndSet(false, true)) return
        var ok = 0
        ok += if (XpHooks.hookResult(cl, MEMBER_UTIL, "d", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, MEMBER_UTIL, "c", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, PROFILE, "getGid", 1)) 1 else 0
        ok += if (XpHooks.hookResult(cl, PROFILE, "getPremiumExpiresAt", "2099-12-31 23:59:59")) 1 else 0

        // 视图绑定层的会员判断
        XpHooks.hookResult(cl, "a3.c", "d", true)
        XpHooks.hookResult(cl, "a3.c2", "d", true)


        toast(ok > 0)
    }



    private fun toast(success: Boolean) {
        runCatching {
            val app = Class.forName("android.app.ActivityThread")
                .getMethod("currentApplication").invoke(null) as android.content.Context
            android.os.Handler(android.os.Looper.getMainLooper()).post {
                android.widget.Toast.makeText(
                    app,
                    if (success) "QLsu：一个木函注入成功" else "QLsu：一个木函注入失败",
                    android.widget.Toast.LENGTH_LONG
                ).show()
            }
        }
    }
}
