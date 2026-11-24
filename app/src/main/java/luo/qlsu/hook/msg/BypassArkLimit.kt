package luo.qlsu.hook.msg

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
    "绕过TIM卡片点击限制",
    "解除TIM中部分卡片无法点击的问题",
    HookCategory.MSG
)
object BypassArkLimit : BaseSwitchHookItem(), DexKitTask {

    private lateinit var checkMethod: Method

    override fun onInit(): Boolean {
        
        if (!HostInfo.isTIM) return false

        checkMethod = requireClass("ArkConfigModel").findMethod {
            returnType = boolean
            paramTypes(string, string)
        }
        return super.onInit()
    }

    override fun onHook() {
        checkMethod.returnConstant(this, true)
    }

    override fun getQueryMap(): Map<String, BaseMatcher> = mapOf(
        "ArkConfigModel" to FindClass().apply {
            searchPackages("com.tencent.mobileqq.aio.msglist.holder.component.ark")
            matcher {
                usingStrings("updateTimArkClickWhiteList")
            }
        }
    )
}