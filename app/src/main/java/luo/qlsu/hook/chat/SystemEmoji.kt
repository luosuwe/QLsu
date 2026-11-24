package luo.qlsu.hook.chat

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass

@HookItemAnnotation(
    "强制使用系统Emoji",
    "屏蔽QQ自带的Emoji表情，强制显示系统Emoji",
    HookCategory.CHAT
)
object SystemEmoji : BaseSwitchHookItem() {
    override fun onHook() {
        val target = "com.tencent.mobileqq.text.EmotcationConstants".toClass
        target.findMethod { name = "getSingleEmoji" }.returnConstant(this, -1)
        target.findMethod { name = "getDoubleEmoji" }.returnConstant(this, -1)
    }
}