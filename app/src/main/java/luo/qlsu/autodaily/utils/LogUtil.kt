package luo.qlsu.autodaily.utils

import android.util.Log
import luo.qlsu.BuildConfig

/**
 * AutoDaily 原来的 LogUtil 依赖它自己的 FileUtil / ConfUnit / XposedBridge。
 * 这里保留完全相同的对外方法签名，实现改成 logcat + QLsu 的错误日志文件。
 */
object LogUtil {

    private const val TAG = "QLsuAD"
    private const val maxLength = 2000

    private val pid by lazy { android.os.Process.myPid() }

    private val enableDebug: Boolean
        get() = BuildConfig.DEBUG

    private fun doLog(f: (String, String) -> Unit, msg: String?, e: Throwable?) {
        val str = buildString {
            msg?.let { append(it) }
            e?.let { append("\n").append(it.stackTraceToString()) }
        }
        if (str.length > maxLength) {
            var i = 0
            while (i < str.length) {
                val sub = str.substring(i, minOf(i + maxLength, str.length))
                f(TAG, sub)
                i += maxLength
            }
        } else {
            f(TAG, str)
        }
    }

    @JvmStatic
    fun log(msg: String) = i(msg)

    @JvmStatic
    fun d(msg: String) {
        if (enableDebug) doLog(Log::d, msg, null)
    }

    @JvmStatic
    fun i(msg: String) = doLog(Log::i, msg, null)

    @JvmStatic
    fun w(msg: String) = doLog(Log::w, msg, null)

    @JvmStatic
    fun e(t: Throwable, msg: String = "") = doLog(Log::e, msg, t)

    @JvmStatic
    fun printStackTrace(e: Throwable = RuntimeException("---getStackTrace---")) {
        d(e.stackTraceToString())
    }

    @JvmStatic
    fun pid(): Int = pid
}
