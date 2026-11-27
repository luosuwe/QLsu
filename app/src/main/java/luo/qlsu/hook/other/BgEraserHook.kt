package luo.qlsu.hook.other

/**
 * 傲软抠图（com.apowersoft.backgrounderaser）会员解锁。
 * 全部走模块自己的 HookEngine，legacy / modern 环境都生效。
 */
object BgEraserHook {

    const val PACKAGE = "com.apowersoft.backgrounderaser"

    fun install(cl: ClassLoader) {
        var ok = 0
        ok += if (XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "isVip", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "hasVipValid", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "hasVipValidOrBalance", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "isExpire", true)) 1 else 0
        ok += if (XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "getDeadlineDate", "9999-12-31")) 1 else 0
        ok += if (XpHooks.hookResult(cl, "com.backgrounderaser.baselib.account.VipManager", "getBalance", 999999L)) 1 else 0
        XpHooks.hookVoid(cl, "com.backgrounderaser.baselib.account.VipManager", "loadVipInfo")
        XpHooks.hookVoid(cl, "com.backgrounderaser.baselib.account.VipManager", "deductConsume")

        XpHooks.hookResult(cl, "com.apowersoft.apilib.bean.MattingUser", "getIs_vip", java.lang.Boolean.TRUE)
        XpHooks.hookResult(cl, "com.apowersoft.apilib.bean.MattingUser", "getVip_deadline", java.lang.Long.valueOf(Long.MAX_VALUE))
        XpHooks.hookResult(cl, "com.apowersoft.apilib.bean.MattingUser", "getRecharge_vip_balance", java.lang.Long.valueOf(999999L))

        patchTextsOnResume(cl)
        toast(ok > 0)
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
                    if (success) "QLsu：傲软抠图会员已解锁（9999-12-31）" else "QLsu：傲软抠图 Hook 未命中",
                    android.widget.Toast.LENGTH_LONG
                ).show()
            }
        }
    }
}
