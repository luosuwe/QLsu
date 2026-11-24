package luo.qlsu.autodaily.hook.inject

import android.content.Intent
import com.tencent.qphone.base.remote.FromServiceMsg
import com.tencent.qphone.base.remote.ToServiceMsg
import luo.qlsu.autodaily.utils.LogUtil
import luo.qlsu.autodaily.utils.toMap
import mqq.app.MSFServlet
import mqq.app.Packet
import java.util.concurrent.ConcurrentHashMap
import java.util.concurrent.atomic.AtomicInteger

/**
 * 与原版一致的自定义 Servlet，但把 seq 生成改成全局唯一，并额外提供 [dispatch]：
 * QLsu 在 MainService.receiveMessageFromMSF 上挂钩子，自己把回包按 appSeq 投递进来，
 * 这样即使宿主版本改了 Servlet 分发路径，群签到 / 收藏之类的同步请求也不会挂死。
 */
abstract class BaseServlet : MSFServlet() {

    protected val seqReceiveMap = ConcurrentHashMap<Int, FromServiceMsg>()

    fun generateSeq(): Int {
        val seq = globalSeq.incrementAndGet()
        pending[seq] = this
        return seq
    }

    fun getReceiveAndRemove(seq: Int): FromServiceMsg? {
        val from = seqReceiveMap.remove(seq)
        pending.remove(seq)
        return from
    }

    override fun onReceive(intent: Intent, fromServiceMsg: FromServiceMsg) {
        val toServiceMsg: ToServiceMsg? =
            intent.getParcelableExtra(ToServiceMsg::class.java.simpleName)
        if (toServiceMsg != null) {
            fromServiceMsg.attributes[FromServiceMsg::class.java.simpleName] = toServiceMsg
            LogUtil.d(toServiceMsg.toString())
            runCatching { LogUtil.d(toServiceMsg.extraData.toMap().toString()) }
            seqReceiveMap[toServiceMsg.appSeq] = fromServiceMsg
        }
        LogUtil.d("${this::class.java.simpleName} -> onReceive: $fromServiceMsg")
    }

    override fun onSend(intent: Intent, packet: Packet) {
        val toServiceMsg: ToServiceMsg? =
            intent.getParcelableExtra(ToServiceMsg::class.java.simpleName)
        toServiceMsg?.let {
            packet.setSSOCommand(toServiceMsg.serviceCmd)
            packet.putSendData(toServiceMsg.wupBuffer)
            packet.setTimeout(toServiceMsg.timeout)
            @Suppress("UNCHECKED_CAST")
            packet.attributes = toServiceMsg.attributes as HashMap<String, Any>?
            if (!toServiceMsg.isNeedCallback) {
                packet.setNoResponse()
            }
        }
    }

    companion object {

        private val globalSeq = AtomicInteger(0)

        /** appSeq -> 发起该请求的 Servlet 实例。 */
        private val pending = ConcurrentHashMap<Int, BaseServlet>()

        /**
         * 把一个 MSF 回包投递给发起请求的 Servlet。
         * @return 命中本模块请求时返回 true
         */
        @JvmStatic
        fun dispatch(toServiceMsg: ToServiceMsg, fromServiceMsg: FromServiceMsg): Boolean {
            val servlet = pending[toServiceMsg.appSeq] ?: return false
            fromServiceMsg.attributes[FromServiceMsg::class.java.simpleName] = toServiceMsg
            servlet.seqReceiveMap[toServiceMsg.appSeq] = fromServiceMsg
            return true
        }
    }
}
