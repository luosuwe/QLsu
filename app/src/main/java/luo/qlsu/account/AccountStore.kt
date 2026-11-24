package luo.qlsu.account

import android.content.Context
import android.content.SharedPreferences

/**
 * 模块 App 侧保存的账号信息（由 QQ 进程通过广播同步过来）。
 */
data class AccountInfo(
    val uin: String,
    val token: String,
    val nick: String,
    val syncedAt: Long,
) {
    val displayName: String get() = nick.ifBlank { uin }
    val initials: String get() = if (uin.length >= 2) uin.takeLast(2) else "QL"
    val isReady: Boolean get() = uin.isNotBlank() && token.isNotBlank()
}

object AccountStore {

    private const val PREFS = "qlsu_account"
    private const val KEY_UIN = "uin"
    private const val KEY_TOKEN = "token"
    private const val KEY_NICK = "nick"
    private const val KEY_SYNCED_AT = "synced_at"

    private fun prefs(context: Context): SharedPreferences =
        context.applicationContext.getSharedPreferences(PREFS, Context.MODE_PRIVATE)

    fun read(context: Context): AccountInfo? {
        val p = prefs(context)
        val uin = p.getString(KEY_UIN, "").orEmpty()
        if (uin.isBlank()) return null
        return AccountInfo(
            uin = uin,
            token = p.getString(KEY_TOKEN, "").orEmpty(),
            nick = p.getString(KEY_NICK, "").orEmpty(),
            syncedAt = p.getLong(KEY_SYNCED_AT, 0L),
        )
    }

    fun save(context: Context, uin: String, token: String, nick: String) {
        if (uin.isBlank()) return
        prefs(context).edit()
            .putString(KEY_UIN, uin)
            .putString(KEY_TOKEN, token)
            .putString(KEY_NICK, nick)
            .putLong(KEY_SYNCED_AT, System.currentTimeMillis())
            .apply()
    }

    fun updateToken(context: Context, token: String) {
        if (token.isBlank()) return
        prefs(context).edit().putString(KEY_TOKEN, token).apply()
    }

    fun clear(context: Context) {
        prefs(context).edit().clear().apply()
    }
}
