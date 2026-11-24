package luo.qlsu.hook.msg

import com.tencent.mobileqq.aio.msglist.holder.component.ptt.AIOPttContentComponent
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findMethod

@HookItemAnnotation(
    "语音消息自动转文本",
    "收到语音消息时自动转换为文字显示",
    HookCategory.MSG
)
object AutoSpeechToText : BaseSwitchHookItem() {

    override fun onInit() = HostInfo.isQQ

    override fun onHook() {
        AIOPttContentComponent::class.java.findMethod {
            returnType = boolean
            paramTypes(boolean)
        }.returnConstant(this, true)
    }
}