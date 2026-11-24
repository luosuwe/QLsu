package luo.qlsu.autodaily.hook.function.impl

import android.content.Intent
import luo.qlsu.autodaily.config.GetProfileRequest
import luo.qlsu.autodaily.config.MiniAppGetProfileServlet
import luo.qlsu.autodaily.config.MsfService
import luo.qlsu.autodaily.hook.FromServiceMsgHook
import luo.qlsu.autodaily.hook.base.load
import luo.qlsu.autodaily.hook.function.base.BaseFunction
import luo.qlsu.autodaily.hook.utils.QApplicationUtil
import luo.qlsu.autodaily.hook.utils.QApplicationUtil.currentUin
import luo.qlsu.autodaily.hook.utils.WupUtil
import luo.qlsu.autodaily.task.exception.TaskTimeoutException
import luo.qlsu.autodaily.task.model.MiniProfile
import luo.qlsu.autodaily.utils.LogUtil
import luo.qlsu.autodaily.utils.invokeAs
import luo.qlsu.autodaily.utils.new
import mqq.app.Packet

open class MiniProfileManager : BaseFunction(
    TAG = "MiniProfileManager"
) {
    private lateinit var cMiniAppGetProfileServlet: Class<*>
    private lateinit var cGetProfileRequest: Class<*>

    override fun init() {
        cMiniAppGetProfileServlet = load(MiniAppGetProfileServlet)
            ?: throw RuntimeException("类加载失败 -> $MiniAppGetProfileServlet")
        cGetProfileRequest = load(GetProfileRequest)
            ?: throw RuntimeException("类加载失败 -> $GetProfileRequest")
    }

    open fun syncGetProfile(miniAppId: String): MiniProfile {
        val startTime = System.currentTimeMillis()
        val id = "syncGetProfile"
        FromServiceMsgHook.resMap[id] = null
        sendGetProfileRequest(miniAppId)
        while (System.currentTimeMillis() - startTime < 10_000) {
            Thread.sleep(120)
            val tmp = FromServiceMsgHook.resMap[id] as MiniProfile?
            tmp?.let {
                FromServiceMsgHook.resMap.remove(id)
                return it
            }
        }
        LogUtil.i("尝试小程序获取用户信息超时")
        throw TaskTimeoutException("尝试小程序获取用户信息超时")
    }

    private fun sendGetProfileRequest(miniAppId: String) {
        val packet = Packet::class.java.new("$currentUin")
        val miniAppGetProfileServlet = cMiniAppGetProfileServlet.new()
        val request = cGetProfileRequest.new(miniAppId, true, "en")
        val traceId: String? = miniAppGetProfileServlet?.invokeAs("getTraceId")
        val intent = Intent().apply {
            putExtra("key_appid", miniAppId)
            putExtra("key_uin", currentUin)
        }
        val sendData: ByteArray? = request?.invokeAs("encode", intent, -1, traceId)
        packet.let {
            it.setSSOCommand("LightAppSvc.mini_user_info.GetProfile")
            it.putSendData(WupUtil.encode(sendData!!))
            it.setTimeout(9999L)
        }
        val toServiceMsg = packet.toMsg()
        toServiceMsg.let {
            it.appId = 537064392
            it.appSeq = miniAppId.toInt()
            it.serviceName = MsfService
        }
        QApplicationUtil.send(toServiceMsg)
    }

}
