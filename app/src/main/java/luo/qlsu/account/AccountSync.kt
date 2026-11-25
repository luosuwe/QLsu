package luo.qlsu.account

import android.app.Activity
import android.content.Intent
import android.net.Uri
import android.util.Log
import luo.qlsu.BuildConfig
import luo.qlsu.common.ModuleScope
import luo.qlsu.utils.net.HttpUtils
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.qq.QQCurrentEnv
import org.json.JSONObject
import java.net.URLEncoder
import kotlinx.coroutines.delay

/**
 * 运行在 QQ / TIM 进程内（被模块注入）：
 * - 激活 / 切号时把当前 QQ 号上报给后端（首次上报即自动注册，密码 = QQ 号）；
 * - 保存后端下发的设备令牌，用于模块 App 里「点头像直接进用户中心」；
 * - 通过广播把 QQ 号 + 令牌同步给模块 App；
 * - 支持由模块 App 唤起后，直接换取一次性票据并打开浏览器。
 */
object AccountSync {

    const val ACTION_SYNC = "luo.qlsu.action.ACCOUNT_SYNC"
    const val EXTRA_UIN = "uin"
    const val EXTRA_TOKEN = "token"
    const val EXTRA_NICK = "nick"

    private const val TAG = "QLsuAccount"
    private const val KEY_LAST_SYNC = "account_last_sync"
    private const val SYNC_INTERVAL_MS = 5 * 60 * 1000L
    private const val SITE = "https://qlsu.luosu.top"

    private fun tokenKey(uin: String) = "account_token_$uin"

    /** 只在宿主主进程上报，避免 QQ 子进程重复注册 */
    fun sync(force: Boolean = false) {
        runCatching {
            if (HostInfo.processName != HostInfo.packageName) return
            val prefs = QQCurrentEnv.globalPreference
            val now = System.currentTimeMillis()
            if (!force && now - prefs.getLong(KEY_LAST_SYNC, 0L) < SYNC_INTERVAL_MS) return
            ModuleScope.launchIO(TAG) { doSync() }
        }.onFailure { Log.w(TAG, "sync failed: ${it.message}") }
    }

    private suspend fun doSync() {
        val uin = currentUin() ?: return
        val prefs = QQCurrentEnv.globalPreference
        val storedToken = prefs.getString(tokenKey(uin), "").orEmpty()

        // 只上报 QQ 号 + 模块版本 + 本地设备令牌；Cookie / skey / pskey / 机型等一律不出本机
        // QQ 启动早期昵称可能还没加载出来，重试几次并清掉零宽字符
        var nick = ""
        for (attempt in 0 until 4) {
            val raw = runCatching { QQCurrentEnv.currentNickName.orEmpty() }.getOrDefault("")
            nick = raw.replace(Regex("[\\u200B-\\u200D\\uFEFF]"), "").trim()
            if (nick.isNotBlank()) break
            if (attempt < 3) runCatching { delay(1200L) }
        }
        val body = buildString {
            append("uin=").append(encode(uin))
            append("&version=").append(encode(BuildConfig.VERSION_NAME))
            if (nick.isNotBlank()) append("&nick=").append(encode(nick.take(32)))
            if (storedToken.isNotBlank()) append("&token=").append(encode(storedToken))
        }
        val response = HttpUtils.postSuspend("${HttpUtils.HOST}/api/heartbeat.php", body)
        val json = runCatching { JSONObject(response) }.getOrNull() ?: return
        if (!json.optBoolean("ok", false)) return

        val freshToken = json.optString("token", "")
        val token = if (freshToken.isNotBlank()) {
            prefs.edit().putString(tokenKey(uin), freshToken).apply()
            freshToken
        } else {
            storedToken
        }
        prefs.edit().putLong(KEY_LAST_SYNC, System.currentTimeMillis()).apply()

        broadcast(uin, token, nick)

        if (json.optBoolean("registered", false)) {
            Log.i(TAG, "QQ $uin 已自动注册（初始密码 = QQ 号）")
        }
    }

    private fun broadcast(uin: String, token: String, nick: String) {
        runCatching {
            val intent = Intent(ACTION_SYNC).apply {
                setPackage(BuildConfig.APPLICATION_ID)
                putExtra(EXTRA_UIN, uin)
                putExtra(EXTRA_TOKEN, token)
                putExtra(EXTRA_NICK, nick)
                addFlags(Intent.FLAG_INCLUDE_STOPPED_PACKAGES)
            }
            HostInfo.hostContext.sendBroadcast(intent)
        }.onFailure { Log.w(TAG, "broadcast failed: ${it.message}") }
    }

    /**
     * 由模块 App 通过 JumpActivity 唤起：用当前 QQ + 令牌换一次性票据，
     * 然后用浏览器打开已登录的用户中心。
     */
    fun openWebUserCenter(activity: Activity?) {
        ModuleScope.launchIO(TAG) {
            val uin = currentUin() ?: return@launchIO
            val token = QQCurrentEnv.globalPreference.getString(tokenKey(uin), "").orEmpty()
            if (token.isBlank()) {
                // 还没拿到令牌，先同步一次再重试
                doSync()
            }
            val effectiveToken = QQCurrentEnv.globalPreference.getString(tokenKey(uin), "").orEmpty()
            if (effectiveToken.isBlank()) {
                toastOnMain("账号同步失败，请检查网络后重试")
                return@launchIO
            }
            val body = "uin=${encode(uin)}&token=${encode(effectiveToken)}"
            val response = HttpUtils.postSuspend("$SITE/api/ticket.php", body)
            val url = runCatching { JSONObject(response).optString("url") }.getOrDefault("")
            if (url.isBlank()) {
                toastOnMain("登录失败：${runCatching { JSONObject(response).optString("message") }.getOrDefault("请稍后重试")}")
                return@launchIO
            }
            val context = activity ?: runCatching { QQCurrentEnv.activity }.getOrNull() ?: HostInfo.hostContext
            val intent = Intent(Intent.ACTION_VIEW, Uri.parse(url)).apply {
                addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
            }
            runCatching { context.startActivity(intent) }
                .onFailure { toastOnMain("没有可用的浏览器") }
        }
    }

    private fun toastOnMain(message: String) {
        ModuleScope.launchMain {
            runCatching {
                android.widget.Toast.makeText(HostInfo.hostContext, message, android.widget.Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun currentUin(): String? {
        val uin = runCatching { QQCurrentEnv.currentUin }.getOrNull().orEmpty()
        if (uin.isBlank() || uin == "0" || !uin.matches(Regex("^\\d{4,12}$"))) return null
        return uin
    }

    private fun encode(value: String): String = URLEncoder.encode(value, "UTF-8")
}
