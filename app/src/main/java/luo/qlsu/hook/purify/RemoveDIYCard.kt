package luo.qlsu.hook.purify

import com.tencent.mobileqq.profilecard.activity.FriendProfileCardActivity
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.doNothing
import luo.qlsu.utils.qq.HostInfo

@HookItemAnnotation(
    "屏蔽DIY名片",
    "屏蔽查看好友页面自定义的名片",
    HookCategory.PURIFY
)
object RemoveDIYCard : BaseSwitchHookItem() {

    override fun onInit() = HostInfo.isQQ
    
    override fun onHook() {
        FriendProfileCardActivity::class.java
            .getDeclaredMethod("handleSwitchVasCard")
            .doNothing(this)
    }

}