package luo.qlsu.hook.social

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.dexkit.DexKitTask
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.hook.hookBefore
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.setObject
import luo.qlsu.utils.reflect.setObjectByType
import luo.qlsu.utils.reflect.toClass
import org.luckypray.dexkit.query.FindClass
import org.luckypray.dexkit.query.base.BaseMatcher

@HookItemAnnotation(
    "移除转发数量限制",
    "解除转发联系人时最多选择9人的限制",
    HookCategory.SOCIAL
)
object RemoveForwardLimit : BaseSwitchHookItem(), DexKitTask {

    private lateinit var configClass: Class<*>
    private lateinit var recentClass: Class<*>
    private lateinit var friendClass: Class<*>
    private lateinit var troopClass: Class<*>

    private val isNew: Boolean
        get() = HostInfo.isQQ && HostInfo.versionCode >= 11820

    override fun onInit(): Boolean {

        if (isNew) {
            configClass = requireClass("ChatSelectorConfig")
        } else {
            recentClass = "com.tencent.mobileqq.activity.ForwardRecentActivity".toClass
            friendClass = "com.tencent.mobileqq.activity.ForwardFriendListActivity".toClass
            troopClass = "com.tencent.mobileqq.activity.ForwardTroopListFragment".toClass
        }

        return super.onInit()
    }

    override fun onHook() {
        if (isNew) {

            configClass.declaredConstructors
                .filter { it.parameterCount >= 3 }
                .forEach {
                    it.hookBefore(this) { param ->
                        param.args[2] = Int.MAX_VALUE
                    }
                }
        } else {

            recentClass.declaredConstructors.forEach {
                it.hookAfter(this) { param ->
                    param.thisObject.setObject("mForwardTargetMap", FakeMap())
                }
            }
            friendClass.declaredConstructors.forEach {
                it.hookAfter(this) { param ->
                    param.thisObject.setObjectByType<Map<*, *>>(FakeMap())
                }
            }
            troopClass.declaredConstructors.forEach {
                it.hookAfter(this) { param ->
                    param.thisObject.setObjectByType<Map<*, *>>(FakeMap())
                }
            }
        }
    }

    override fun getQueryMap(): Map<String, BaseMatcher> = mapOf(
        "ChatSelectorConfig" to FindClass().apply {
            matcher {
                usingStrings("ChatSelectorConfig")
            }
        }
    )

}

class FakeMap : LinkedHashMap<Any, Any>() {
    override val size: Int
        get() {
            val s = super.size
            return if (s == 9) 8 else s
        }
}