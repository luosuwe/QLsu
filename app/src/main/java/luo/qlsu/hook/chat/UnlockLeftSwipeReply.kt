package luo.qlsu.hook.chat

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.replaceFirstParam
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass
import java.lang.reflect.Method

@HookItemAnnotation(
    "解除左滑回复限制",
    "解除部分类型消息无法左滑回复的限制",
    HookCategory.CHAT
)
object UnlockLeftSwipeReply : BaseSwitchHookItem() {

    private lateinit var setSwipeEnable: Method

    override fun onInit(): Boolean {
        setSwipeEnable = "com.tencent.mobileqq.aio.msglist.holder.component.leftswipearea.AIOContentLeftSwipeHelper".toClass
            .findMethod {
                returnType = void
                paramTypes(boolean)
            }
        return super.onInit()
    }

    override fun onHook() {
        setSwipeEnable.replaceFirstParam(true, this)
    }
}