package luo.qlsu.hook.api

import com.tencent.qqnt.kernel.nativeinterface.MsgRecord
import com.tencent.qqnt.kernelpublic.nativeinterface.Contact
import kotlinx.coroutines.delay
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.common.ModuleScope
import luo.qlsu.hook.base.BaseApiHookItem
import luo.qlsu.hook.base.Listener
import luo.qlsu.utils.dexkit.DexKitTask
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.findMethod
import org.luckypray.dexkit.query.FindClass
import org.luckypray.dexkit.query.base.BaseMatcher
import java.lang.reflect.Modifier

@HookItemAnnotation("监听接收消息")
object OnReceiveMsg : BaseApiHookItem<ReceiveMsgListener>(), DexKitTask {

    @Suppress("UNCHECKED_CAST")
    override fun loadHook() {

        val msgService = requireClass("msgService")

        msgService.findMethod {
            name = "onAddSendMsg"
        }.hookAfter(this) { param ->

            val msgRecord = param.args[0] as MsgRecord

            if (msgRecord.elements.isEmpty()) return@hookAfter

            ModuleScope.launchIO("onSelfMsg") {

                delay(250)

                QQCurrentEnv.kernelMsgService?.getMsgsByMsgId(
                    Contact(msgRecord.chatType, msgRecord.peerUid, msgRecord.guildId),
                    arrayListOf(msgRecord.msgId)
                ) { _, _, arrayList ->
                    val record = arrayList.firstOrNull() ?: msgRecord
                    forEachChecked { it.onReceive(record) }
                }

            }


        }

        msgService.findMethod {
            name = "onRecvMsg"
        }.hookAfter(this) { param ->

            val msgRecords = param.args[0] as ArrayList<MsgRecord>

            if (msgRecords[0].elements.isEmpty()) return@hookAfter

            forEachChecked { it.onReceive(msgRecords[0]) }
        }
    }

    override fun getQueryMap(): Map<String, BaseMatcher> = mapOf(
        "msgService" to FindClass().apply {
            searchPackages("com.tencent.qqnt.msg")
            excludePackages("com.tencent.qqnt.msg.migration")
            matcher {
                modifiers(Modifier.FINAL)
                methods {
                    add { name("onRecvMsg") }
                    add { name("onAddSendMsg") }
                }
            }
        }
    )
}

fun interface ReceiveMsgListener : Listener {
    fun onReceive(msgRecord: MsgRecord)
}