package luo.qlsu.hook.other

import de.robv.android.xposed.XC_MethodHook
import de.robv.android.xposed.XposedBridge
import de.robv.android.xposed.XposedHelpers

/**
 * Bg Eraser（com.apowersoft.backgrounderaser）会员解锁。
 * 模块作用域勾选该应用后生效：免登录、永久 VIP、昵称 QLsu、头像用模块图标。
 */
object BgEraserHook {

    const val PACKAGE = "com.apowersoft.backgrounderaser"

    private const val AVATAR = "https://qlsu.luosu.top/files/icon.png"

    private var installed = false

    fun install(cl: ClassLoader) {
        runCatching {
            val actCls = XposedHelpers.findClass("android.app.Activity", cl)
            XposedBridge.hookAllMethods(actCls, "onResume", object : XC_MethodHook() {
                override fun afterHookedMethod(param: MethodHookParam) {
                    if (installed) return
                    installed = true
                    runCatching { doInstall(cl) }
                }
            })
        }
    }

    private fun doInstall(cl: ClassLoader) {
        var ok = 0
        ok += if (runCatching { vipManager(cl) }.isSuccess) 1 else 0
        ok += if (runCatching { beans(cl) }.isSuccess) 1 else 0
        toast("QLsu：傲软抠图会员已解锁（永久）", ok > 0)
    }

    /** Activity 显示后遍历 View 树，把「开通会员，畅享所有功能」换成到期时间 */
    private fun patchViews(cl: ClassLoader) {
        runCatching {
            val actCls = XposedHelpers.findClass("android.app.Activity", cl)
            XposedBridge.hookAllMethods(actCls, "onResume", object : XC_MethodHook() {
                override fun afterHookedMethod(param: MethodHookParam) {
                    val activity = param.thisObject as? android.app.Activity ?: return
                    listOf(300L, 1000L).forEach { delay ->
                        android.os.Handler(android.os.Looper.getMainLooper()).postDelayed({
                            runCatching { walk(activity.window.decorView) }
                        }, delay)
                    }
                }
            })
        }
    }

    private fun walk(v: android.view.View) {
        if (v is android.widget.TextView) {
            val t = v.text?.toString().orEmpty()
            if (t.contains("开通会员")) v.text = "有效期至：9999-12-31"
            if (t.contains("有效期") && t.any { it.isDigit() }) v.text = "有效期至：9999-12-31"
        }
        if (v is android.view.ViewGroup) {
            for (i in 0 until v.childCount) walk(v.getChildAt(i))
        }
    }

    private fun toast(text: String, success: Boolean) {
        runCatching {
            val app = Class.forName("android.app.ActivityThread")
                .getMethod("currentApplication").invoke(null) as android.content.Context
            android.os.Handler(android.os.Looper.getMainLooper()).post {
                android.widget.Toast.makeText(app, text, android.widget.Toast.LENGTH_LONG).show()
            }
        }
    }

    private fun hookAll(
        cl: ClassLoader,
        className: String,
        method: String,
        replacement: (XC_MethodHook.MethodHookParam) -> Any?
    ) {
        val cls = XposedHelpers.findClass(className, cl)
        cls.declaredMethods.filter { it.name == method }.forEach { m ->
            XposedBridge.hookMethod(m, object : XC_MethodHook() {
                override fun beforeHookedMethod(param: MethodHookParam) {
                    param.result = replacement(param)
                }
            })
        }
    }





    private fun vipManager(cl: ClassLoader) {
        val cn = "com.backgrounderaser.baselib.account.VipManager"
        hookAll(cl, cn, "isVip") { true }
        hookAll(cl, cn, "hasVipValid") { true }
        hookAll(cl, cn, "hasVipValidOrBalance") { true }
        hookAll(cl, cn, "isExpire") { false }
        hookAll(cl, cn, "getDeadlineDate") { "9999-12-31" }
        hookAll(cl, cn, "getBalance") { 999999L }
        hookAll(cl, cn, "getVipInfo") { runCatching { fakeMattingUser(cl) }.getOrNull() }
        hookAll(cl, cn, "loadVipInfo") { null }
        hookAll(cl, cn, "deductConsume") { null }
    }

    private fun fakeMattingUser(cl: ClassLoader): Any {
        val cls = XposedHelpers.findClass("com.apowersoft.apilib.bean.MattingUser", cl)
        val obj = runCatching { XposedHelpers.newInstance(cls) }.getOrElse {
            // 没有无参构造：用 Unsafe 直接分配，避免构造函数校验
            runCatching {
                val unsafe = Class.forName("sun.misc.Unsafe").getDeclaredField("theUnsafe")
                    .apply { isAccessible = true }.get(null)
                val alloc = unsafe.javaClass.getMethod("allocateInstance", Class::class.java)
                alloc.invoke(unsafe, cls)
            }.getOrElse {
                XposedHelpers.newInstance(cls, *arrayOfNulls<Any?>(0))
            }
        }
        fun set(name: String, value: Any?) {
            runCatching { XposedHelpers.setObjectField(obj, name, value) }
        }
        set("is_vip", java.lang.Boolean.TRUE)
        set("vip_deadline", java.lang.Long.valueOf(Long.MAX_VALUE))
        set("recharge_vip_balance", java.lang.Long.valueOf(999999L))
        set("balance", 999999L)
        set("nickname", "QLsu")
        set("is_recharge_vip", java.lang.Boolean.TRUE)
        return obj
    }

    /** 把「开通会员，畅享所有功能」这类横幅改成会员文案 */
    private fun banner(cl: ClassLoader) {
        runCatching {
            val cls = XposedHelpers.findClass("android.widget.TextView", cl)
            cls.declaredMethods.filter { it.name == "setText" && it.parameterTypes.size == 1 }.forEach { m ->
                XposedBridge.hookMethod(m, object : XC_MethodHook() {
                    override fun beforeHookedMethod(param: MethodHookParam) {
                        val raw = param.args[0]
                        val s = when (raw) {
                            is Int -> {
                                runCatching {
                                    val res = (Class.forName("android.app.ActivityThread")
                                        .getMethod("currentApplication").invoke(null)
                                        as android.content.Context).resources
                                    res.getString(raw)
                                }.getOrDefault("")
                            }
                            else -> raw?.toString().orEmpty()
                        }
                        when {
                            s.contains("有效期至") || s.contains("有效期") ->
                                param.args[0] = "有效期至：9999-12-31"
                            s.contains("开通会员") -> param.args[0] = "有效期至：9999-12-31"
                            s.contains("立即续费") -> param.args[0] = "立即续费"
                            s.contains("续费") -> param.args[0] = "立即续费"
                        }
                    }
                })
            }
        }
    }

    /** 「我的」页刷新后覆写会员文案 */
    private fun myPage(cl: ClassLoader) {
        runCatching {
            val cls = XposedHelpers.findClass("V0.a", cl)
            cls.declaredMethods.filter { it.name == "k" && it.parameterCount == 0 }.forEach { m ->
                XposedBridge.hookMethod(m, object : XC_MethodHook() {
                    override fun afterHookedMethod(param: MethodHookParam) {
                        runCatching {
                            val binding = XposedHelpers.getObjectField(param.thisObject, "binding") ?: return
                            fun setText(field: String, text: String) {
                                runCatching {
                                    val tv = XposedHelpers.getObjectField(binding, field) as? android.widget.TextView
                                    tv?.text = text
                                }
                            }
                            setText("tvUserName", "QLsu")
                            setText("tvUserId", "UID: QLsu")
                            setText("tvVipHint", "有效期至：9999-12-31")
                            setText("tvResidue", "999999")
                            setText("tvBuyVip", "立即续费")
                            setText("tvBuyDesc", "有效期至：9999-12-31")
                        }
                    }
                })
            }
        }
    }

    private fun beans(cl: ClassLoader) {
        val mu = "com.apowersoft.apilib.bean.MattingUser"
        hookAll(cl, mu, "getIs_vip") { java.lang.Boolean.TRUE }
        hookAll(cl, mu, "getVip_deadline") { java.lang.Long.valueOf(Long.MAX_VALUE) }
        hookAll(cl, mu, "getRecharge_vip_balance") { java.lang.Long.valueOf(999999L) }
    }

    /** 任何「有效期至 + 日期」的文案统一改成「永久」 */
    private fun textFallback(cl: ClassLoader) {
        val cls = XposedHelpers.findClass("android.widget.TextView", cl)
        cls.declaredMethods.filter { it.name == "setText" && it.parameterTypes.size == 1 }
            .forEach { m ->
                XposedBridge.hookMethod(m, object : XC_MethodHook() {
                    override fun beforeHookedMethod(param: MethodHookParam) {
                        val s = param.args[0]?.toString().orEmpty()
                        if (s.contains("有效期") && s.any { it.isDigit() }) {
                            param.args[0] = "有效期至：永久"
                        }
                    }
                })
            }
    }
}
