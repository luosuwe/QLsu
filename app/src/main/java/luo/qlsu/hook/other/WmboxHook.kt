package luo.qlsu.hook.other

import de.robv.android.xposed.XC_MethodHook
import de.robv.android.xposed.XposedBridge
import de.robv.android.xposed.XposedHelpers
import java.lang.reflect.Method
import java.lang.reflect.Modifier

/**
 * 一个木函（com.One.WoodenLetter）会员解锁。
 * 模块作用域勾选「一个木函」后生效。
 */
object WmboxHook {

    const val PACKAGE = "com.One.WoodenLetter"

    private const val MEMBER_UTIL = "com.One.WoodenLetter.activitys.user.util.a"
    private const val PROFILE = "cn.woobx.databinding.model.AccountDataModel\$AccountData\$Profile"

    fun install(cl: ClassLoader) {
        runCatching {
            val appCls = XposedHelpers.findClass("android.app.Application", cl)
            XposedBridge.hookAllMethods(appCls, "onCreate", object : XC_MethodHook() {
                override fun afterHookedMethod(param: MethodHookParam) {
                    doInstall(cl)
                }
            })
        }.onFailure { doInstall(cl) }
    }

    private fun doInstall(cl: ClassLoader) {
        var ok = 0
        ok += if (runCatching { hookReturn(cl, MEMBER_UTIL, "d", true) }.isSuccess) 1 else 0
        ok += if (runCatching { hookReturn(cl, MEMBER_UTIL, "c", true) }.isSuccess) 1 else 0
        ok += if (runCatching { hookReturn(cl, PROFILE, "getGid", 1) }.isSuccess) 1 else 0
        ok += if (runCatching { hookReturn(cl, PROFILE, "getPremiumExpiresAt", "2099-12-31 23:59:59") }.isSuccess) 1 else 0
        runCatching { hookReturn(cl, PROFILE, "getNickname", "QLsu") }
        runCatching { fakeAccountData(cl) }
        runCatching { blockPaywallDialog(cl) }
        // 列表/卡片绑定层的会员判断（a3.c / a3.c2 的 d()）
        listOf("a3.c", "a3.c2").forEach { cn ->
            runCatching { hookReturn(cl, cn, "d", true) }
        }
        ok += if (runCatching { allBooleanTrue(cl) }.isSuccess) 1 else 0
        toast(ok > 0)
    }

    private fun toast(success: Boolean) {
        runCatching {
            val app = Class.forName("android.app.ActivityThread")
                .getMethod("currentApplication").invoke(null) as android.content.Context
            android.os.Handler(android.os.Looper.getMainLooper()).post {
                android.widget.Toast.makeText(
                    app,
                    if (success) "QLsu：一个木函会员已解锁（永久）" else "QLsu：一个木函会员 Hook 未命中",
                    android.widget.Toast.LENGTH_LONG
                ).show()
            }
        }
    }

    /** 让 a.b() 返回带会员资料的账号对象，防止代码直接读字段 */
    private fun fakeAccountData(cl: ClassLoader) {
        val util = XposedHelpers.findClass("com.One.WoodenLetter.activitys.user.util.a", cl)
        val dataCls = XposedHelpers.findClass("cn.woobx.databinding.model.AccountDataModel\$AccountData", cl)
        val profCls = XposedHelpers.findClass("cn.woobx.databinding.model.AccountDataModel\$AccountData\$Profile", cl)
        val profile = newInstanceUnsafe(profCls)
        runCatching { XposedHelpers.setObjectField(profile, "gid", Integer.valueOf(1)) }
        runCatching { XposedHelpers.setObjectField(profile, "premiumExpiresAt", "2099-12-31 23:59:59") }
        runCatching { XposedHelpers.setObjectField(profile, "nickname", "QLsu") }
        val data = newInstanceUnsafe(dataCls)
        runCatching { XposedHelpers.setObjectField(data, "profile", profile) }
        util.declaredMethods.filter { it.name == "b" && it.parameterCount == 0 }.forEach { m ->
            XposedBridge.hookMethod(m, object : XC_MethodHook() {
                override fun beforeHookedMethod(param: MethodHookParam) { param.result = data }
            })
        }
    }

    /**
     * com.google.android.gms.internal.mlkit_vision_common.i6.b(Activity)
     * 就是弹「当前功能仅限付费会员使用」的方法，直接空实现，任何漏网判断都不会再拦截。
     */
    private fun blockPaywallDialog(cl: ClassLoader) {
        val cls = XposedHelpers.findClass("com.google.android.gms.internal.mlkit_vision_common.i6", cl)
        cls.declaredMethods
            .filter { it.name == "b" && it.parameterTypes.size == 1 }
            .forEach { m ->
                XposedBridge.hookMethod(m, object : XC_MethodHook() {
                    override fun beforeHookedMethod(param: MethodHookParam) { param.result = null }
                })
            }
    }

    private fun newInstanceUnsafe(cls: Class<*>): Any {
        return runCatching { XposedHelpers.newInstance(cls) }.getOrElse {
            val unsafe = Class.forName("sun.misc.Unsafe").getDeclaredField("theUnsafe")
                .apply { isAccessible = true }.get(null)
            unsafe.javaClass.getMethod("allocateInstance", Class::class.java).invoke(unsafe, cls)
        }
    }

    private fun hookReturn(cl: ClassLoader, className: String, method: String, value: Any) {
        val cls = XposedHelpers.findClass(className, cl)
        val list = cls.declaredMethods.filter { it.name == method }
        if (list.isEmpty()) throw NoSuchMethodException("$className.$method")
        list.forEach { m ->
            XposedBridge.hookMethod(m, object : XC_MethodHook() {
                override fun beforeHookedMethod(param: MethodHookParam) {
                    param.result = value
                }
            })
        }
    }



    /** 会员工具类里所有无参 boolean 一律 true（覆盖不同版本的混淆名） */
    private fun allBooleanTrue(cl: ClassLoader) {
        val cls = XposedHelpers.findClass("com.One.WoodenLetter.activitys.user.util.a", cl)
        cls.declaredMethods
            .filter { it.returnType == Boolean::class.javaPrimitiveType && it.parameterCount == 0 }
            .forEach { m ->
                XposedBridge.hookMethod(m, object : XC_MethodHook() {
                    override fun beforeHookedMethod(param: MethodHookParam) {
                        param.result = true
                    }
                })
            }
    }

    /** 版本兼容兜底：业务包里名字带 vip/member/premium 的静态无参 boolean 一律 true */
    private fun sweep(cl: ClassLoader) {
        val keys = listOf("vip", "member", "premium", "ispro", "privilege")
        val pkgs = listOf(
            "com.One.WoodenLetter.activitys.user.util",
            "com.One.WoodenLetter.util",
            "com.One.WoodenLetter.services"
        )
        pkgs.forEach { pkg ->
            ('a'..'z').forEach { c ->
                runCatching {
                    val k = XposedHelpers.findClass("$pkg.$c", cl)
                    k.declaredMethods.forEach { m: Method ->
                        val n = m.name.lowercase()
                        if (m.returnType == Boolean::class.javaPrimitiveType &&
                            Modifier.isStatic(m.modifiers) &&
                            m.parameterCount == 0 &&
                            keys.any { n.contains(it) }
                        ) {
                            XposedBridge.hookMethod(m, object : XC_MethodHook() {
                                override fun beforeHookedMethod(param: MethodHookParam) {
                                    param.result = true
                                }
                            })
                        }
                    }
                }
            }
        }
    }
}
