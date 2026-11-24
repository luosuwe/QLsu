package luo.qlsu.hook.social

import com.tencent.mobileqq.quibadge.QUIBadge
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.hookAfter

@HookItemAnnotation(
    "显示具体消息数量",
    "主页聊天界面显示具体消息数量而非99+",
    HookCategory.SOCIAL
)
object ExactMsgCount : BaseSwitchHookItem() {

    override fun onHook() {
        QUIBadge::class.java
            .getDeclaredMethod("updateNum", Int::class.javaPrimitiveType)
            .hookAfter(this) {
                val num = it.args[0].toString()
                QUIBadge::class.java.getDeclaredField("mText").apply {
                    isAccessible = true
                    set(it.thisObject, num)
                }
            }
    }
}