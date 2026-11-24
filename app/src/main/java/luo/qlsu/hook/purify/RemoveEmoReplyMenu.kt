package luo.qlsu.hook.purify

import com.tencent.mobileqq.aio.msg.AIOMsgItem
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.doNothing
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass
import java.lang.reflect.Method

@HookItemAnnotation(
    "移除表情回应",
    "移除长按出现的表情回应菜单以及消息下方表情回应",
    HookCategory.PURIFY
)
object RemoveEmoReplyMenu : BaseSwitchHookItem() {

    private lateinit var handleUIState: Method

    private lateinit var getMenuView: Method

    override fun onInit(): Boolean {
        handleUIState = "com.tencent.mobileqq.aio.msglist.holder.component.msgtail.AIOGeneralMsgTailContentComponent".toClass
            .findMethod {
                returnType = void
                paramTypes(int, AIOMsgItem::class.java, list)
            }
        getMenuView = "com.tencent.qqnt.aio.api.impl.AIOEmoReplyMenuApiImpl".toClass
            .findMethod {
                name =
                    if (HostInfo.versionCode >= 9898) "getSeparateEmoReplyMenuView" else "getEmoReplyMenuView"
            }
        return super.onInit()
    }

    override fun onHook() {
        getMenuView.doNothing(this)
        handleUIState.doNothing(this)
    }

}