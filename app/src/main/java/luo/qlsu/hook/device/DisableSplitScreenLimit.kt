package luo.qlsu.hook.device

import android.app.Activity
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.reflect.findMethod

@HookItemAnnotation(
    "伪装处于非多窗口模式",
    "解除分屏状态下扫码等功能的使用限制",
    HookCategory.DEVICE,
    "All"
)
object DisableSplitScreenLimit : BaseSwitchHookItem() {

    override fun onHook() {
        Activity::class.java
            .findMethod {
                name = "isInMultiWindowMode"
            }
            .returnConstant(this, false)
    }
}