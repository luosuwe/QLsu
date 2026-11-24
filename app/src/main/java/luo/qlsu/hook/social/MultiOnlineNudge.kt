package luo.qlsu.hook.social

import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.input.KeyboardType
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
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass
import java.lang.reflect.Method

@HookItemAnnotation(
    "在线好友连拍",
    "点击好友在线列表拍一拍与私聊回拍时可输入次数",
    HookCategory.SOCIAL
)
object MultiOnlineNudge : BaseSwitchHookItem() {

    private lateinit var sendNudge: Method

    private lateinit var rateLimitCheck: Method

    override fun onInit(): Boolean {
        if (HostInfo.isTIM || (HostInfo.isQQ && HostInfo.versionCode < 14880)) return false
        val managerClass = "com.tencent.mobileqq.onlinestatus.proto.OnlineStatusNudgeManager".toClass

        sendNudge = managerClass.findMethod {
            returnType = void
            paramTypes(string, null, null)
        }

        rateLimitCheck = managerClass.findMethod {
            returnType = long
            paramTypes(string)
        }
        return super.onInit()
    }

    override fun onHook() {
        rateLimitCheck.returnConstant(this, 0L)
        sendNudge.hookReplace(this) {
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
                            num < 1 && filtered.isNotEmpty() -> "1"
                            else -> filtered
                        }
                    },
                    label = "拍一拍次数",
                    hint = "请输入发送次数",
                    modifier = Modifier,
                    keyboardType = KeyboardType.Number
                )
            }
        }.show()
    }
}