package luo.qlsu.hook.qrcode

import android.os.Bundle
import com.tencent.biz.qrcode.activity.QRLoginAuthActivity
import com.tencent.biz.qui.quibutton.QUIButton
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.common.ModuleScope
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.reflect.getObjectByType

@HookItemAnnotation(
    "跳过扫码确认等待时间",
    "可忽略倒计时，直接点击确认即可",
    HookCategory.OTHER
)
object SkipScanWaitTime : BaseSwitchHookItem() {

    override fun onHook() {

        QRLoginAuthActivity::class.java
            .getDeclaredMethod("doOnCreate", Bundle::class.java)
            .hookAfter(this) { param ->
                val activity = param.thisObject
                val confirmButton = activity.getObjectByType<QUIButton>()

                ModuleScope.launchDelayed(100) {
                    confirmButton.isEnabled = true
                    confirmButton.setType(0)
                }

            }
    }
}