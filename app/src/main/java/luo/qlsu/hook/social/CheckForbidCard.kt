package luo.qlsu.hook.social

import com.tencent.mobileqq.data.Card
import com.tencent.mobileqq.profilecard.activity.FriendProfileCardActivity
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.hookBefore
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass

@HookItemAnnotation(
    "查看封号资料卡",
    "去除查看封禁账号资料卡的限制",
    HookCategory.SOCIAL
)
object CheckForbidCard : BaseSwitchHookItem() {

    override fun onHook() {
        val activity = if (HostInfo.isTIM)
            "com.tencent.mobileqq.profilecard.activity.TimFriendProfileCardActivity".toClass
        else FriendProfileCardActivity::class.java

        activity.findMethod {
                name = "onCardUpdate"
            }
            .hookBefore(this) { param ->
                val card = param.args[0] as Card
                card.forbidCode = 0
                card.isForbidAccount = false
            }

    }
}