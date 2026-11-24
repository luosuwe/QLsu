package luo.qlsu.hook.qrcode

import com.tencent.open.agent.QrAgentLoginManager
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.replaceFirstParam
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.findMethodOrNull
import java.lang.reflect.Method

@HookItemAnnotation(
    "解除扫码限制",
    "解除长按识别或从相册中扫描二维码时的风险检查",
    HookCategory.OTHER
)
object RemoveQrCodeCheck : BaseSwitchHookItem() {

    private lateinit var check: Method

    override fun onInit(): Boolean {

        val manager = QrAgentLoginManager::class.java

        check = manager.findMethodOrNull {
            returnType = void
            paramTypes(boolean, string, bundle)
        } ?: manager.findMethod {
            returnType = void
            paramTypes(manager, boolean, string, bundle)
        }
        return super.onInit()
    }

    override fun onHook() {
        check.replaceFirstParam(false, this)
    }
}