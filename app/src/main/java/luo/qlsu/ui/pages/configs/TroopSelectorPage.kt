package luo.qlsu.ui.pages.configs

import androidx.compose.runtime.Composable
import luo.qlsu.conf.TroopSetConfig
import luo.qlsu.ui.components.biz.AsyncSelectorDialog
import luo.qlsu.ui.components.dialogs.SelectionItem
import luo.qlsu.utils.qq.TroopTool

@Composable
fun TroopSelectorPage(
    title: String,
    currentConfig: TroopSetConfig,
    onSave: (TroopSetConfig) -> Unit,
    onDismiss: () -> Unit
) {
    AsyncSelectorDialog(
        title = title,
        currentSelection = currentConfig.selectedSet,
        dataLoader = TroopTool::getGroupList,
        mapper = { SelectionItem(it.group, it.groupName) },
        onDismiss = onDismiss,
        onConfirm = {
            onSave(TroopSetConfig(it))
            onDismiss()
        }
    )
}
