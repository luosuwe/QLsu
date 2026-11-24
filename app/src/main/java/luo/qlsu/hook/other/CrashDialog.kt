package luo.qlsu.hook.other

import androidx.compose.runtime.Composable
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.conf.CrashConfig
import luo.qlsu.hook.base.BaseClickableHookItem
import luo.qlsu.ui.pages.configs.CrashDialogPage

@HookItemAnnotation(
    "崩溃提示",
    "崩溃时弹出提示窗口，点击可细调弹窗条件",
    HookCategory.OTHER
)
object CrashDialog : BaseClickableHookItem<CrashConfig>(CrashConfig.serializer(), defaultEnable = true) {

    override val defaultConfig: CrashConfig = CrashConfig()

    @Composable
    override fun ConfigContent(onDismiss: () -> Unit) {
        CrashDialogPage(
            currentConfig = config,
            onSave = ::updateConfig,
            onDismiss = onDismiss
        )
    }
}