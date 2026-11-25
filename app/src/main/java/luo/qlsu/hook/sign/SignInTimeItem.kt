package luo.qlsu.hook.sign

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.AlertDialog
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableIntStateOf
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import kotlinx.serialization.Serializable
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseClickableHookItem
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.ui.luosu.pressClick

@Serializable
data class SignTimeConfig(val hour: Int = 0, val minute: Int = 0)

/**
 * 签到分类最上面的「签到时间」：弹窗式设置，和定时任务的设置时间一样。
 * 已打开的签到项统一在这个时间执行，默认 00:00。
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
        var picking by remember { mutableStateOf<String?>(null) }
        val colors = QLsuTheme.colors

        AlertDialog(
            onDismissRequest = onDismiss,
            title = { Text("设置 · 签到时间") },
            text = {
                Column {
                    Text("已打开的签到项每天在这个时间执行", fontSize = 11.sp, color = colors.textSecondary)
                    Spacer(Modifier.height(10.dp))
                    Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                        TimeChip("%02d".format(hour), "时") { picking = "hour" }
                        TimeChip("%02d".format(minute), "分") { picking = "minute" }
                    }
                }
            },
            confirmButton = {
                TextButton(onClick = {
                    updateConfig(SignTimeConfig(hour, minute))
                    SignInSync.applyAll()
                    onDismiss()
                }) { Text("保存") }
            },
            dismissButton = { TextButton(onClick = onDismiss) { Text("取消") } }
        )

        when (picking) {
            "hour" -> NumberPicker("选择小时", 0..23, hour, { picking = null }) { hour = it }
            "minute" -> NumberPicker("选择分钟", 0..59, minute, { picking = null }) { minute = it }
        }
    }
}

@Composable
private fun TimeChip(value: String, unit: String, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Row(
        modifier = Modifier
            .clip(RoundedCornerShape(12.dp))
            .background(colors.accentBlue.copy(alpha = 0.10f))
            .pressClick(onClick = onClick)
            .padding(horizontal = 14.dp, vertical = 10.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Text(value, fontSize = 18.sp, fontWeight = FontWeight.Bold, color = colors.accentBlue)
        Spacer(Modifier.padding(start = 2.dp))
        Text(unit, fontSize = 11.sp, color = colors.accentBlue)
    }
}

@Composable
private fun NumberPicker(
    title: String,
    range: IntRange,
    value: Int,
    onDismiss: () -> Unit,
    onPick: (Int) -> Unit,
) {
    AlertDialog(
        onDismissRequest = onDismiss,
        title = { Text(title) },
        text = {
            LazyColumn(Modifier.height(280.dp)) {
                items(range.toList()) { n ->
                    val selected = n == value
                    Box(
                        Modifier
                            .fillMaxWidth()
                            .pressClick { onPick(n); onDismiss() }
                            .padding(vertical = 10.dp, horizontal = 8.dp)
                    ) {
                        Text(
                            text = "%02d".format(n),
                            fontSize = 16.sp,
                            fontWeight = if (selected) FontWeight.Bold else FontWeight.Normal,
                            color = if (selected) QLsuTheme.colors.accentBlue else QLsuTheme.colors.textPrimary
                        )
                    }
                }
            }
        },
        confirmButton = { TextButton(onClick = onDismiss) { Text("关闭") } }
    )
}
