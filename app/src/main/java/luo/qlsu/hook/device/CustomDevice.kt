package luo.qlsu.hook.device

import androidx.compose.runtime.Composable
import com.tencent.qmethod.pandoraex.monitor.DeviceInfoMonitor
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.conf.DeviceConfig
import luo.qlsu.hook.base.BaseClickableHookItem
import luo.qlsu.ui.pages.configs.CustomDevicePage
import luo.qlsu.utils.hook.returnConstant

@HookItemAnnotation(
    "伪装设备在线状态",
    "点击设置机型，可用于设置在线状态机型（包含文字可能无效）",
    HookCategory.DEVICE,
    "All"
)
object CustomDevice : BaseClickableHookItem<DeviceConfig>(DeviceConfig.serializer()) {

    override val isNeedRestart: Boolean = true

    override val defaultConfig: DeviceConfig = DeviceConfig()

    override fun onHook() {
        DeviceInfoMonitor::class.java
            .getDeclaredMethod("getModel")
            .returnConstant(this, config.fakeModel)
    }

    @Composable
    override fun ConfigContent(onDismiss: () -> Unit) {
        CustomDevicePage(
            currentConfig = config,
            onSave = ::updateConfig,
            onDismiss = onDismiss
        )
    }
}
