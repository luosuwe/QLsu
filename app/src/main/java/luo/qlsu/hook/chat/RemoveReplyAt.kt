package luo.qlsu.hook.chat

import com.tencent.mobileqq.aio.event.AIOMsgSendEvent
import com.tencent.mobileqq.aio.msg.AIOMsgItem
import com.tencent.mvi.base.route.MsgIntent
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.dexkit.DexKitTask
import luo.qlsu.utils.hook.hookReplace
import luo.qlsu.utils.hook.invokeOriginal
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.getObjectByTypeOrNull
import org.luckypray.dexkit.query.FindClass
import org.luckypray.dexkit.query.base.BaseMatcher
import java.lang.reflect.Method

@HookItemAnnotation(
    "去除回复自动艾特",
    "引用消息时不再自动添加艾特",
    HookCategory.CHAT
)
object RemoveReplyAt : BaseSwitchHookItem(), DexKitTask {

    private lateinit var handleMsgIntent: Method

    override fun onInit(): Boolean {
        handleMsgIntent =
            requireClass("reply").findMethod {
                returnType = void
                paramTypes(MsgIntent::class.java)
            }
        return super.onInit()
    }

    override fun onHook() {

        handleMsgIntent.hookReplace(this) { param ->

            if (param.args[0] !is AIOMsgSendEvent.MsgOnClickReplyEvent)
                return@hookReplace param.invokeOriginal()
            val aioMsgItem = param.args[0]?.getObjectByTypeOrNull<AIOMsgItem>()
                ?: return@hookReplace param.invokeOriginal()
            val msgRecord = aioMsgItem.msgRecord
            val senderUid = msgRecord.senderUid
            msgRecord.senderUid = ""
            param.invokeOriginal()
            msgRecord.senderUid = senderUid

        }
    }

    override fun getQueryMap(): Map<String, BaseMatcher> = mapOf(
        "reply" to FindClass().apply {
            searchPackages("com.tencent.mobileqq.aio.input.reply")
            matcher {
                methods {
                    add { name("onDestroy") }
                    add { returnType(Set::class.java) }
                }
            }
        }
    )

}