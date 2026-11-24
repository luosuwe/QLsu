package luo.qlsu.hook.purify

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.toClass

@HookItemAnnotation(
    "屏蔽QQ秀",
    "屏蔽新版QQ秀头像",
    HookCategory.PURIFY
)
object RemoveQQShow : BaseSwitchHookItem() {

    override fun onInit() = HostInfo.versionCode >= 11820

    override fun onHook() {

        "com.tencent.mobileqq.ai.avatar.api.impl.AIAvatarSwitchApiImpl".toClass
            .getDeclaredMethod(
                "hasAvatarUrlOrInfo",
                Long::class.java
            )
            .hookAfter(this) {
                if (it.args[0] != QQCurrentEnv.currentUin.toLong()) it.result = false
            }
    }
}