package luo.qlsu.autodaily.hook.utils

import com.tencent.qphone.base.remote.FromServiceMsg
import luo.qlsu.autodaily.config.StGetCodeRsp
import luo.qlsu.autodaily.config.StGetProfileRsp
import luo.qlsu.autodaily.config.StQWebRsp
import luo.qlsu.autodaily.hook.base.load
import luo.qlsu.autodaily.task.model.MiniProfile
import luo.qlsu.autodaily.utils.fieldValue
import luo.qlsu.autodaily.utils.invoke
import luo.qlsu.autodaily.utils.invokeAs
import luo.qlsu.autodaily.utils.new

object ServiceMsgParseUtil {

    fun parseLoginCode(fromServiceMsg: FromServiceMsg): String? {
        val res = load(StQWebRsp)?.new()
        var wupBuffer = fromServiceMsg.fieldValue("wupBuffer") as ByteArray?
        wupBuffer = WupUtil.decode(wupBuffer)
        res?.invoke("mergeFrom", wupBuffer)
        val busiBuff = res?.fieldValue("busiBuff")
        val byteString = busiBuff?.invoke("get")
        val bytes = byteString?.invoke("toByteArray")
        val codeRes = load(StGetCodeRsp)?.new()
        codeRes?.invoke("mergeFrom", bytes)
        val pbCode = codeRes?.fieldValue("code")
        return pbCode?.invokeAs("get")
    }

    fun parseProfile(fromServiceMsg: FromServiceMsg): MiniProfile {
        val res = load(StQWebRsp)?.new()
        var wupBuffer = fromServiceMsg.fieldValue("wupBuffer") as ByteArray?
        wupBuffer = WupUtil.decode(wupBuffer)
        res?.invoke("mergeFrom", wupBuffer)
        val busiBuff = res?.fieldValue("busiBuff")
        val byteString = busiBuff?.invoke("get")
        val bytes = byteString?.invoke("toByteArray")
        val profileRes = load(StGetProfileRsp)?.new()
        profileRes?.invoke("mergeFrom", bytes)
        val userInfo = profileRes?.fieldValue("user")
        val avatar: String = userInfo?.fieldValue("avatar")?.invokeAs("get") ?: ""
        val nick: String = userInfo?.fieldValue("nick")?.invokeAs("get") ?: ""
        return MiniProfile(avatar, nick)
    }
}