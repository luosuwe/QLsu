package luo.qlsu.autodaily.hook.function.impl

import com.tencent.mobileqq.mp.mobileqq_mp
import luo.qlsu.autodaily.config.MsfService
import luo.qlsu.autodaily.config.StQWebReq
import luo.qlsu.autodaily.hook.base.load
import luo.qlsu.autodaily.hook.function.base.BaseFunction
import luo.qlsu.autodaily.hook.utils.QApplicationUtil
import luo.qlsu.autodaily.hook.utils.QApplicationUtil.currentUin
import luo.qlsu.autodaily.hook.utils.ServletUtil
import luo.qlsu.autodaily.hook.utils.VersionUtil
import luo.qlsu.autodaily.hook.utils.WupUtil
import luo.qlsu.autodaily.utils.new
import mqq.app.Packet

open class PublicAccountManager : BaseFunction(
    TAG = "PublicAccountManager"
) {
    override fun init() {
        load(StQWebReq)
            ?: throw RuntimeException("类加载失败 -> ${StQWebReq}")
        load("cooperation.qzone.PlatformInfor")
            ?: throw RuntimeException("类加载失败 -> PlatformInfor")
    }

    open fun vipPublicAccountSignIn() {
        val request = mobileqq_mp.SendMenuEventRequest().apply {
            uin.set(2659464438.toInt())
            type.set(1)
            key.set("VIP_PUB_SUBBUTTON_QIANDAO")
            msg_id.set(0L)
            s_type.set(1)
            versionInfo.set(VersionUtil.qqVersionInfo)
            menu_type.set(0)
        }
        val sendData = ServletUtil.encodeReq(-1, request.toByteArray())
        val packet = Packet::class.java.new("$currentUin").apply {
            setSSOCommand("CertifiedAccountSvc.certified_account_write.SendMenuEvent")
            putSendData(WupUtil.encode(sendData))
            setTimeout(9999L)
        }
        val toServiceMsg = packet.toMsg().apply {
            appId = 537064392
            appSeq = 23333333
            serviceName = MsfService
        }
        QApplicationUtil.send(toServiceMsg)
    }
}