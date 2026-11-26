package luo.qlsu.account

import android.app.Activity
import android.content.Context
import android.content.Intent
import android.widget.Toast
import android.os.Handler
import android.os.Looper
import luo.qlsu.utils.net.HttpUtils
import org.json.JSONObject
import androidx.core.net.toUri
import luo.qlsu.hook.entry.QlsuEntryHook
import java.net.URLEncoder

/**
 * 用户中心入口：
 * - 模块 App 内点头像 / 用户中心 → 打开登录页，必须输入 QQ 号 + 密码；
 * - 在 QQ 菜单里点头像 → 由 QQ 进程用设备令牌换一次性票据，自动登录（见 AccountSync.openWebUserCenter）。
 */
object UserCenterLauncher {

    const val SITE = "https://qlsu.luosu.top"

    /**
     * 模块 App 内点击头像 / 用户中心：
     * 有本地设备令牌 → 用令牌换一次性票据，浏览器直接进入已登录的用户中心；
     * 没有令牌（还没同步过）→ 退回到登录页。
     */
    fun open(context: Context) {
        val info = AccountStore.read(context)
        if (info == null || info.uin.isBlank() || info.token.isBlank()) {
            val url = buildString {
                append(SITE).append("/login.php")
                if (info != null && info.uin.isNotBlank()) append("?uin=").append(encode(info.uin))
            }
            startBrowser(context, url)
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
                    startBrowser(context, "$SITE/login.php?uin=${encode(info.uin)}")
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
