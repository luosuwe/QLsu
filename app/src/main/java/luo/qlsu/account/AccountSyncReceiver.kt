package luo.qlsu.account

import android.content.BroadcastReceiver
import android.content.Context
import android.content.Intent

/**
 * 接收 QQ 进程（QLsu 模块）同步过来的当前登录 QQ 与设备令牌。
 * 只在模块 App 侧使用，不需要任何权限。
 */
class AccountSyncReceiver : BroadcastReceiver() {

    override fun onReceive(context: Context, intent: Intent) {
        if (intent.action != AccountSync.ACTION_SYNC) return
        val uin = intent.getStringExtra(AccountSync.EXTRA_UIN).orEmpty()
        val token = intent.getStringExtra(AccountSync.EXTRA_TOKEN).orEmpty()
        val nick = intent.getStringExtra(AccountSync.EXTRA_NICK).orEmpty()
        if (uin.isBlank()) return
        AccountStore.save(context, uin, token, nick)
    }
}
