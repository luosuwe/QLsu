package luo.qlsu.hook.entry

import android.app.Activity
import android.content.Intent
import luo.qlsu.account.AccountSync
import luo.qlsu.activity.SettingActivity
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.log.LogUtils
import luo.qlsu.utils.reflect.findMethodOrNull
import luo.qlsu.utils.reflect.toClass

/**
 * 不再往 QQ 的设置页/加号面板/标签栏里塞按钮。
 * 模块 App 通过带 extra 的 JumpActivity 唤起宿主里的 QLsu 设置页：
 *   Intent(com.tencent.mobileqq.activity.JumpActivity).putExtra("qlsu_open", true)
 */
object QlsuEntryHook {

    const val EXTRA_OPEN = "qlsu_open"
    const val EXTRA_PAGE = "qlsu_page"

    fun install() {
        val jumpClass = runCatching { "com.tencent.mobileqq.activity.JumpActivity".toClass }.getOrNull() ?: return
        jumpClass.findMethodOrNull { name = "onCreate" }?.hookAfter { param ->
            val activity = param.thisObject as? Activity ?: return@hookAfter
            val intent = activity.intent ?: return@hookAfter
            if (!intent.getBooleanExtra(EXTRA_OPEN, false)) return@hookAfter
            runCatching {
                val page = intent.getStringExtra(EXTRA_PAGE)
                // 模块 App 点头像：由 QQ 进程换取一次性票据并打开已登录的用户中心
                if (page == "account" || page == "usercenter") {
                    AccountSync.openWebUserCenter(activity)
                } else {
                    activity.startActivity(
                        Intent(activity, SettingActivity::class.java).apply {
                            putExtra(EXTRA_PAGE, page)
                            addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
                        }
                    )
                }
                activity.finish()
            }.onFailure { LogUtils.e("QlsuEntry", it) }
        }
    }
}
