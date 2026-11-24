package luo.qlsu.hook.chat

import com.tencent.qqnt.kernel.nativeinterface.MsgElement
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.common.ModuleScope
import luo.qlsu.hook.api.MenuClickListener
import luo.qlsu.hook.api.OnGetRKey
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.plugin.bean.MsgData
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.net.HttpUtils
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.qq.MsgTool
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.findMethodOrNull
import luo.qlsu.utils.reflect.toClass
import java.io.File
import java.lang.reflect.Constructor
import java.lang.reflect.Method

@HookItemAnnotation(
    "快捷重发消息",
    "撤回自己发出的图文复合消息时自动将消息插入输入框",
    HookCategory.CHAT
)
object FastReSend : BaseSwitchHookItem(), MenuClickListener {

    private lateinit var recoverElements: Method

    private lateinit var ctor: Constructor<*>

    private var delegate: Any? = null

    override val menuKey: String = "[QLsu],$name,撤回重发,,2,9"

    override fun onClick(msgData: MsgData) {

        if (msgData.userUin != QQCurrentEnv.currentUin) return

        val elements = msgData.data.elements

        MsgTool.recallMsg(msgData.contact, msgData.msgId)
        ModuleScope.launchIO { recoverElements(elements, msgData.type) }
    }

    override fun onInit(): Boolean {
        val delegateClass = "com.tencent.mobileqq.aio.input.draft.InputDraftVMDelegate".toClass
        recoverElements = delegateClass.findMethodOrNull {
            visibility = private
            returnType = void
            paramTypes(list)
        } ?: delegateClass.findMethod {
            isStatic = true
            returnType = void
            paramTypes(delegateClass, list)
        }
        ctor = delegateClass.constructors.first()
        return super.onInit()
    }

    override fun onHook() {
        ctor.hookAfter(this) { delegate = it.thisObject }
    }

    suspend fun recoverElements(elements: ArrayList<MsgElement>, chatType: Int) {
        if (HostInfo.isTIM || (HostInfo.isQQ && HostInfo.versionCode <= 13188)) {
            elements.mapNotNull {
                it.picElement
            }.forEach {
                val rkey = if (chatType == 2) OnGetRKey.groupRkey else OnGetRKey.friendRkey
                val url = "https://multimedia.nt.qq.com.cn${it.originImageUrl}$rkey"
                val fileName = "net_img_${it.md5HexStr}"
                val savePath = "${QQCurrentEnv.currentDir}cache/images/$fileName"
                if (File(savePath).exists() || HttpUtils.downloadSuspend(url, savePath)) {
                    it.fileName = savePath
                }
            }
        }
        if (recoverElements.parameterCount == 2) {
            recoverElements.invoke(null, delegate, elements)
        } else {
            recoverElements.invoke(delegate, elements)
        }
    }

}