package luo.qlsu.hook.social

import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.input.KeyboardType
import com.tencent.mobileqq.paiyipai.PaiYiPaiHandler
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.loader.hookapi.Chain
import luo.qlsu.ui.components.atoms.DialogTextField
import luo.qlsu.ui.components.dialogs.CenterDialogContainer
import luo.qlsu.ui.core.compatibility.QLsuCenterDialog
import luo.qlsu.utils.hook.hookReplace
import luo.qlsu.utils.hook.invokeOriginal
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.findMethodOrNull
import java.lang.reflect.Method

@HookItemAnnotation(
    "拍一拍连拍",
    "双击头像后可输入次数(单日上限200)",
    HookCategory.SOCIAL
)
object MultiPaiYiPai : BaseSwitchHookItem() {

    private lateinit var sendPai: Method

    private lateinit var check: Method

    override fun onInit(): Boolean {

        val handler = PaiYiPaiHandler::class.java

        sendPai = handler.findMethodOrNull {
            returnType = void
            paramTypes(string, string, int, int)
        } ?: handler.findMethod {
            returnType = void
            paramTypes(int, int, string, string)
        }

        check = handler.findMethod {
            returnType = boolean
            paramTypes(string)
        }
        return super.onInit()
    }

    override fun onHook() {

        check.returnConstant(this, true)

        sendPai.hookReplace(this) {
            showDialog(it)
            return@hookReplace null
        }

    }

    private fun showDialog(param: Chain) {
        val activity = QQCurrentEnv.activity ?: return

        QLsuCenterDialog(activity) { dismiss ->
            var count by remember { mutableStateOf("1") }

            CenterDialogContainer(title = "请输入次数", onDismiss = dismiss, onConfirm = {
                dismiss()
                val num = count.toIntOrNull() ?: 1
                repeat(times = num) { param.invokeOriginal() }
            }) {
                DialogTextField(
                    value = count,
                    onValueChange = { newValue ->
                        val filtered = newValue.filter { it.isDigit() }
                        val num = filtered.toIntOrNull() ?: 0
                        count = when {
                            filtered.isEmpty() -> ""
                            num > 200 -> "200"
                            num < 1 && filtered.isNotEmpty() -> "1"
                            else -> filtered
                        }
                    },
                    label = "拍一拍次数",
                    hint = "1-200",
                    modifier = Modifier,
                    keyboardType = KeyboardType.Number
                )
            }
        }.show()
    }
}