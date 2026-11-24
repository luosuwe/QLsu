package luo.qlsu.hook.purify

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findMethods
import luo.qlsu.utils.reflect.toClass

@HookItemAnnotation(
    "屏蔽AIO动画特效",
    "屏蔽聊天界面中的关键词彩蛋、表情连击、超级表情等全屏动画",
    HookCategory.PURIFY
)
object BlockAIOEffects : BaseSwitchHookItem() {

    override fun onInit() = HostInfo.isQQ

    override fun onHook() {
        "com.tencent.mobileqq.aio.animation.AIOAnimationContainer".toClass
            .findMethods {
                returnType = boolean
                paramTypes(int, int, objArr)
            }
            .forEach { it.returnConstant(this, true) }
    }
}