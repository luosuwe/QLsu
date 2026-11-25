package luo.qlsu.hook.sign

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.width
import androidx.compose.material3.Button
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableIntStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import kotlinx.serialization.Serializable
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseClickableHookItem

@Serializable
data class SignTimeConfig(val hour: Int = 0, val minute: Int = 0)

/**
 * 签到分类里的「签到时间」：已打开的签到项统一在这个时间执行，默认 00:00。
 */
@HookItemAnnotation(
    tag = "签到时间",
    desc = "已打开的签到项每天在这个时间统一执行（默认 00:00）",
    category = HookCategory.SIGN
)
object SignInTimeItem : BaseClickableHookItem<SignTimeConfig>(SignTimeConfig.serializer(), true) {

    override val defaultConfig: SignTimeConfig = SignTimeConfig()

    @Composable
    override fun ConfigContent(onDismiss: () -> Unit) {
        var hour by remember { mutableIntStateOf(config.hour) }
        var minute by remember { mutableIntStateOf(config.minute) }

        Column(
            modifier = Modifier.fillMaxSize().padding(20.dp),
            verticalArrangement = Arrangement.spacedBy(14.dp)
        ) {
            Text("签到总执行时间", fontSize = 18.sp, fontWeight = FontWeight.Bold)
            Text("已打开的签到项会在每天这个时间执行", fontSize = 12.sp)
            Row(
                horizontalArrangement = Arrangement.spacedBy(10.dp),
                verticalAlignment = Alignment.CenterVertically
            ) {
                Button(onClick = { hour = (hour + 23) % 24 }) { Text("-") }
                Text("%02d".format(hour), fontSize = 22.sp)
                Button(onClick = { hour = (hour + 1) % 24 }) { Text("+") }
                Spacer(Modifier.width(18.dp))
                Button(onClick = { minute = (minute + 55) % 60 }) { Text("-") }
                Text("%02d".format(minute), fontSize = 22.sp)
                Button(onClick = { minute = (minute + 5) % 60 }) { Text("+") }
            }
            Button(onClick = {
                updateConfig(SignTimeConfig(hour, minute))
                SignInSync.applyAll()
                onDismiss()
            }) { Text("保存") }
        }
    }
}
