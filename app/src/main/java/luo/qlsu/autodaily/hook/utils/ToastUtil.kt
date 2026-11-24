package luo.qlsu.autodaily.hook.utils

import android.os.Handler
import android.os.Looper
import android.widget.Toast
import luo.qlsu.autodaily.hook.base.hostContext

object ToastUtil {

    private val mainHandler by lazy { Handler(Looper.getMainLooper()) }

    fun send(msg: String?, isLong: Boolean = false) {
        if (msg.isNullOrEmpty()) return
        val context = runCatching { hostContext }.getOrNull() ?: return
        mainHandler.post {
            runCatching {
                Toast.makeText(
                    context,
                    msg,
                    if (isLong) Toast.LENGTH_LONG else Toast.LENGTH_SHORT
                ).show()
            }
        }
    }
}
