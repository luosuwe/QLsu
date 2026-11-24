package luo.qlsu.hook.purify

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.doNothing
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.clazz
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass

@HookItemAnnotation(
    "屏蔽弹出动画",
    "屏蔽某些特定文本消息弹出的与游戏相关的烦人动画",
    HookCategory.PURIFY
)
object AntiInteractivePop : BaseSwitchHookItem() {

    override fun onInit() = HostInfo.isQQ

    override fun onHook() {
        listOf(
            "com.tencent.mobileqq.springhb.interactive.ui.InteractivePopManager",
            "com.tencent.mobileqq.aio.animation.pag.PagEasterEggPopManager"
        ).forEach {
            it.clazz?.findMethod {
                returnType = void
                paramTypes(
                    "androidx.fragment.app.Fragment".toClass,
                    null,
                    null,
                    "kotlin.jvm.functions.Function0".toClass
                )
            }?.doNothing(this)
        }
    }
}