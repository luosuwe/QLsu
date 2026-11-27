package luo.qlsu.hook.other

/**
 * 傲软抠图（com.apowersoft.backgrounderaser）会员解锁。
 * 全部走模块自己的 HookEngine，legacy / modern 环境都生效。
 */
object BgEraserHook {

    const val PACKAGE = "com.apowersoft.backgrounderaser"

    private val installing = java.util.concurrent.atomic.AtomicBoolean(false)

    fun install(cl: ClassLoader) {
        if (!installing.compareAndSet(false, true)) return
        var failed = false
        runCatching {
            XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "isVip", true)
            XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "hasVipValid", true)
            XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "hasVipValidOrBalance", true)
            XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "isExpire", true)
            XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "getDeadlineDate", "9999-12-31")
            XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "getBalance", 999999L)
            XpHooks.hookVoid(cl, "com.backgrounderaser.baselib.account.VipManager", "loadVipInfo")
            XpHooks.hookVoid(cl, "com.backgrounderaser.baselib.account.VipManager", "deductConsume")
            XpHooks.hookResult(cl, "com.apowersoft.apilib.bean.MattingUser", "getIs_vip", java.lang.Boolean.TRUE)
            XpHooks.hookResult(cl, "com.apowersoft.apilib.bean.MattingUser", "getVip_deadline", java.lang.Long.valueOf(Long.MAX_VALUE))
            XpHooks.hookResult(cl, "com.apowersoft.apilib.bean.MattingUser", "getRecharge_vip_balance", java.lang.Long.valueOf(999999L))
            hookTextViews(cl)
            patchMyPage(cl)
        }.onFailure { failed = true }
        toast(!failed)
    }

    /** 直接 Hook TextView.setText，CharSequence / 资源 id 两种都拦 */
    private fun hookTextViews(cl: ClassLoader) {
        val tv = XpHooks.clazz(cl, "android.widget.TextView") ?: return
        tv.declaredMethods.filter { it.name == "setText" && it.parameterCount == 1 }.forEach { m ->
            runCatching {
                luo.qlsu.loader.hookapi.HookEngineManager.engine.hookBefore(m) { p ->
                    val raw = p.args.getOrNull(0)
                    val text = when (raw) {
                        is Int -> runCatching {
                            val app = Class.forName("android.app.ActivityThread")
                                .getMethod("currentApplication").invoke(null) as android.content.Context
                            app.resources.getString(raw)
                        }.getOrDefault("")
                        else -> raw?.toString().orEmpty()
                    }
                    if (text.contains("开通会员") || (text.contains("有效期") && text.any { it.isDigit() })) {
                        p.args[0] = "有效期至：9999-12-31"
                    }
                }
            }
        }
    }

    /** 「我的」页 k() 执行后递归遍历 View 树兜底 */
    private fun patchMyPage(cl: ClassLoader) {
        val cls = XpHooks.clazz(cl, "V0.a") ?: return
        cls.declaredMethods.filter { it.name == "k" && it.parameterCount == 0 }.forEach { m ->
            runCatching {
                luo.qlsu.loader.hookapi.HookEngineManager.engine.hookAfter(m) { p ->
                    val frag = p.thisObject
                    runCatching {
                        val view = frag.javaClass.getMethod("getView").invoke(frag) as? android.view.View
                        walk(view)
                    }
                }
            }
        }
    }

    /** Activity 显示后遍历 View 树，把「开通会员 / 任何有效期日期」改成 9999-12-31 */
    private fun patchTextsOnResume(cl: ClassLoader) {
        val act = XpHooks.clazz(cl, "android.app.Activity") ?: return
        act.declaredMethods.filter { it.name == "onResume" && it.parameterCount == 0 }.forEach { m ->
            runCatching {
                luo.qlsu.loader.hookapi.HookEngineManager.engine.hookAfter(m) {
                    val activity = it.thisObject as? android.app.Activity ?: return@hookAfter
                    listOf(300L, 1000L).forEach { delay ->
                        android.os.Handler(android.os.Looper.getMainLooper()).postDelayed({
                            runCatching { walk(activity.window?.decorView) }
                        }, delay)
                    }
                }
            }
        }
    }

    private fun walk(v: android.view.View?) {
        if (v == null) return
        if (v is android.widget.TextView) {
            val t = v.text?.toString().orEmpty()
            if (t.contains("开通会员") || (t.contains("有效期") && t.any { it.isDigit() })) {
                v.text = "有效期至：9999-12-31"
            }
        }
        if (v is android.view.ViewGroup) {
            for (i in 0 until v.childCount) walk(v.getChildAt(i))
        }
    }

    private fun toast(success: Boolean) {
        runCatching {
            val app = Class.forName("android.app.ActivityThread")
                .getMethod("currentApplication").invoke(null) as android.content.Context
            android.os.Handler(android.os.Looper.getMainLooper()).post {
                android.widget.Toast.makeText(
                    app,
                    if (success) "QLsu v" + luo.qlsu.BuildConfig.VERSION_NAME + " 傲软抠图注入成功" else "QLsu v" + luo.qlsu.BuildConfig.VERSION_NAME + " 傲软抠图注入失败",
                    android.widget.Toast.LENGTH_LONG
                ).show()
            }
        }
    }
}
