package luo.qlsu.hook.api

import com.tencent.qqnt.kernel.nativeinterface.IKernelMsgService
import com.tencent.qqnt.kernel.nativeinterface.MsgElement
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseApiHookItem
import luo.qlsu.hook.base.Listener
import luo.qlsu.utils.hook.hookBefore
import luo.qlsu.utils.reflect.findMethod

@HookItemAnnotation("监听发送消息")
object OnSendMsg : BaseApiHookItem<SendMsgListener>() {


    @Suppress("UNCHECKED_CAST")
    override fun loadHook() {
        IKernelMsgService.CppProxy::class.java
            .findMethod {
                name = "sendMsg"
            }.hookBefore(this) { param ->

                val elements = param.args[2] as ArrayList<MsgElement>
                forEachChecked { it.onSend(elements) }
            }
    }

}

fun interface SendMsgListener : Listener {
    fun onSend(elements: ArrayList<MsgElement>)
}