package luo.qlsu.hook.chat

import com.tencent.qqnt.kernel.nativeinterface.MsgAttributeInfo
import com.tencent.qqnt.kernel.nativeinterface.MsgRecord
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.api.GetMsgRecordListener
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.qq.QQCurrentEnv

@HookItemAnnotation(
    "默认气泡和字体",
    "在聊天界面中将他人的气泡和字体全部显示为默认",
    HookCategory.CHAT
)
object DefaultBubbleAndFont : BaseSwitchHookItem(), GetMsgRecordListener {

    override fun onGet(msgRecord: MsgRecord) {
        if (msgRecord.senderUin != QQCurrentEnv.currentUin.toLong())
            msgRecord.msgAttrs = HashMap<Int, MsgAttributeInfo>()

    }

}