package luo.qlsu.hook.msg

import com.tencent.mobileqq.aio.msg.AIOMsgItem
import com.tencent.qqnt.kernel.nativeinterface.MsgRecord
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.dexkit.DexKitTask
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findMethod
import org.luckypray.dexkit.query.FindClass
import org.luckypray.dexkit.query.base.BaseMatcher
import java.lang.reflect.Method

@HookItemAnnotation(
    "查看聊天记录回复消息",
    "强制查看聊天记录回复消息中包含的图片消息",
    HookCategory.MSG
)
object RecordsReplyCheck : BaseSwitchHookItem(), DexKitTask {

    private lateinit var check: Method

    override fun onInit(): Boolean {
        if (HostInfo.isQQ && HostInfo.versionCode > 9906) {
            check = requireClass("repo")
                .findMethod {
                    returnType = long
                    paramTypes(MsgRecord::class.java, AIOMsgItem::class.java)
                }
            return super.onInit()
        }
        return false
    }

    override fun onHook() {
        check.returnConstant(this, 1L)
    }

    override fun getQueryMap(): Map<String, BaseMatcher> = mapOf(
        "repo" to FindClass().apply {
            searchPackages("com.tencent.mobileqq.aio.msglist.msgrepo")
            matcher {
                usingStrings("AIOMsgRepo MsgReplyAbility")
            }
        }
    )

}