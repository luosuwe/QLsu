package luo.qlsu.hook.other

/**
 * 一个木函（com.One.WoodenLetter）会员解锁。
 * 走模块自己的 HookEngine，legacy / modern 都生效。
 */
object WmboxHook {

    const val PACKAGE = "com.One.WoodenLetter"

    private const val MEMBER_UTIL = "com.One.WoodenLetter.activitys.user.util.a"
    private const val PROFILE = "cn.woobx.databinding.model.AccountDataModel\$AccountData\$Profile"

    fun install(cl: ClassLoader) {
        var ok = 0
        ok += if (XpHooks.hookResult(cl, MEMBER_UTIL, "d", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, MEMBER_UTIL, "c", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, PROFILE, "getGid", 1)) 1 else 0
        ok += if (XpHooks.hookResult(cl, PROFILE, "getPremiumExpiresAt", "2099-12-31 23:59:59")) 1 else 0

        // 视图绑定层的会员判断
        XpHooks.hookResult(cl, "a3.c", "d", true)
        XpHooks.hookResult(cl, "a3.c2", "d", true)

        fakeAccountData(cl)

        // 付费弹窗方法：直接空实现（mlkit_vision_common.i6.b(Activity)）
        XpHooks.hookVoid(cl, "com.google.android.gms.internal.mlkit_vision_common.i6", "b", 1)

        toast(ok > 0)
    }

    private fun fakeAccountData(cl: ClassLoader) {
        val profileCls = XpHooks.clazz(cl, PROFILE) ?: return
        val dataCls = XpHooks.clazz(cl, "cn.woobx.databinding.model.AccountDataModel\$AccountData") ?: return
        val profile = newInstance(profileCls)
        runCatching { profileCls.getField("gid").set(profile, 1) }
        runCatching { profileCls.getField("premiumExpiresAt").set(profile, "2099-12-31 23:59:59") }
        runCatching { profileCls.getField("nickname").set(profile, "QLsu") }
        val data = newInstance(dataCls)
        runCatching { dataCls.getField("profile").set(data, profile) }
        runCatching {
            dataCls.declaredMethods.filter { it.name == "getProfile" }.forEach { m ->
                m.isAccessible = true
                luo.qlsu.loader.hookapi.HookEngineManager.engine.hookBefore(m) { p -> p.result = profile }
            }
        }
        XpHooks.hookResult(cl, MEMBER_UTIL, "b", data)
    }

    private fun newInstance(cls: Class<*>): Any {
        return runCatching { cls.getDeclaredConstructor().newInstance() }.getOrElse {
            val unsafe = Class.forName("sun.misc.Unsafe").getDeclaredField("theUnsafe")
                .apply { isAccessible = true }.get(null)
            unsafe.javaClass.getMethod("allocateInstance", Class::class.java).invoke(unsafe, cls)
        }
    }

    private fun toast(success: Boolean) {
        runCatching {
            val app = Class.forName("android.app.ActivityThread")
                .getMethod("currentApplication").invoke(null) as android.content.Context
            android.os.Handler(android.os.Looper.getMainLooper()).post {
                android.widget.Toast.makeText(
                    app,
                    if (success) "QLsu：一个木函会员已解锁" else "QLsu：一个木函 Hook 未命中",
                    android.widget.Toast.LENGTH_LONG
                ).show()
            }
        }
    }
}
