package luo.qlsu.account

import android.app.Activity
import android.content.Context
import android.content.Intent
import android.os.Handler
import android.os.Looper
import android.widget.Toast
import androidx.core.net.toUri
import luo.qlsu.hook.entry.QlsuEntryHook
import luo.qlsu.utils.net.HttpUtils
import org.json.JSONObject
import java.net.URLEncoder

/**
 * 模块 App 里点「头像 / 用户中心」时使用：
 * 1. 本地已有 QQ + 设备令牌 → 用令牌换一次性票据，浏览器打开已登录的用户中心；
 * 2. 没有同步过 → 通过 JumpActivity 唤起 QQ 内的 QLsu，在那边同步并打开。
 */
object UserCenterLauncher {

    const val SITE = "https://qlsu.luosu.top"

    fun open(context: Context) {
        val info = AccountStore.read(context)
        if (info == null || !info.isReady) {
            openViaHost(context)
            return
        }
        Thread {
            val body = "uin=${encode(info.uin)}&token=${encode(info.token)}"
            val resp = HttpUtils.postSync("$SITE/api/ticket.php", body)
            val url = runCatching { JSONObject(resp).optString("url") }.getOrDefault("")
            Handler(Looper.getMainLooper()).post {
                if (url.isNotBlank()) {
                    startBrowser(context, url)
                } else {
                    Toast.makeText(context, "登录失效，正在通过 QQ 重新同步…", Toast.LENGTH_SHORT).show()
                    openViaHost(context)
                }
            }
        }.start()
    }

    /** 兜底：唤起 QQ 里的 QLsu（JumpActivity + qlsu_open），由 QQ 进程换取票据并打开浏览器 */
    fun openViaHost(context: Context) {
        val pkg = when {
            isInstalled(context, "com.tencent.mobileqq") -> "com.tencent.mobileqq"
            isInstalled(context, "com.tencent.tim") -> "com.tencent.tim"
            else -> null
        }
        if (pkg == null) {
            Toast.makeText(context, "没有找到 QQ / TIM，请先安装并激活模块", Toast.LENGTH_SHORT).show()
            return
        }
        val intent = Intent().apply {
            setClassName(pkg, "com.tencent.mobileqq.activity.JumpActivity")
            putExtra(QlsuEntryHook.EXTRA_OPEN, true)
            putExtra(QlsuEntryHook.EXTRA_PAGE, "account")
            addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
        }
        runCatching { context.startActivity(intent) }
            .onFailure { Toast.makeText(context, "打开失败：${it.message}", Toast.LENGTH_SHORT).show() }
    }

    private fun startBrowser(context: Context, url: String) {
        val intent = Intent(Intent.ACTION_VIEW, url.toUri()).apply {
            addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
        }
        runCatching { context.startActivity(intent) }
            .onFailure { Toast.makeText(context, "没有可用的浏览器", Toast.LENGTH_SHORT).show() }
    }

    fun openUrl(context: Context, url: String) = startBrowser(context, url)

    private fun isInstalled(context: Context, pkg: String): Boolean =
        runCatching { context.packageManager.getPackageInfo(pkg, 0); true }.getOrDefault(false)

    private fun encode(value: String): String = URLEncoder.encode(value, "UTF-8")
}
