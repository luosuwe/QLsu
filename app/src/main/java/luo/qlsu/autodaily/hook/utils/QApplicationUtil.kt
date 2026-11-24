package luo.qlsu.autodaily.hook.utils

import android.content.Context
import com.tencent.common.app.AppInterface
import com.tencent.qphone.base.remote.ToServiceMsg
import luo.qlsu.autodaily.hook.base.hostApp
import luo.qlsu.autodaily.hook.base.load
import luo.qlsu.autodaily.utils.invoke
import luo.qlsu.utils.qq.QQCurrentEnv
import mqq.app.AppRuntime

/**
 * 宿主 AppRuntime 访问层。
 * 与原实现保持一致（currentUin 为 Long），底层直接复用 QLsu 的 QQCurrentEnv。
 */
object QApplicationUtil {

    val application: Context get() = hostApp

    val appRuntime: AppRuntime
        get() = QQCurrentEnv.qQAppInterface

    val appInterface: AppInterface
        get() = appRuntime as AppInterface

    val currentUin: Long
        get() = appRuntime.longAccountUin

    private val msf: Any by lazy {
        load("com.tencent.mobileqq.msf.sdk.MsfServiceSdk")!!.invoke("get")!!
    }

    fun send(toServiceMsg: ToServiceMsg) {
        msf.invoke("sendMsg", toServiceMsg)
    }

    fun isNtQQ(): Boolean {
        return load("com.tencent.qqnt.base.BaseActivity") != null
    }
}
