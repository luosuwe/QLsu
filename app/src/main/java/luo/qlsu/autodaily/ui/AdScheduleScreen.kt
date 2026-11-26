package luo.qlsu.autodaily.ui

import android.os.Bundle
import androidx.activity.compose.BackHandler
import androidx.activity.compose.setContent
import androidx.compose.foundation.background
import androidx.compose.foundation.border
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.WindowInsets
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.statusBars
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.layout.windowInsetsPadding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.foundation.text.BasicTextField
import androidx.compose.material3.AlertDialog
import androidx.compose.material3.OutlinedTextField
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableIntStateOf
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.TextStyle
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import luo.qlsu.activity.BaseComposeActivity
import luo.qlsu.autodaily.AdEngine
import luo.qlsu.autodaily.hook.config.Config.accountConfig
import luo.qlsu.autodaily.hook.utils.ToastUtil
import luo.qlsu.autodaily.store.ScheduledTask
import luo.qlsu.autodaily.store.ScheduledTaskStore
import luo.qlsu.autodaily.task.cron.pattent.CronPattern
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.util.ConfigUtil
import luo.qlsu.autodaily.task.util.Const
import luo.qlsu.ui.components.atoms.QLsuSwitch
import luo.qlsu.ui.core.theme.Dimens
import luo.qlsu.ui.luosu.GlassBackButton
import luo.qlsu.ui.luosu.glassSurface
import luo.qlsu.ui.luosu.pressClick
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.utils.qq.FriendTool
import luo.qlsu.utils.qq.TroopTool

/** 四个预设任务，对应签到任务库里的同名任务 */
private enum class Preset(
    val title: String,
    val desc: String,
    val taskId: String,
    val targetEnv: String,
    val messageEnv: String?,
    val isGroup: Boolean,
    val defaultCron: String,
) {
    FRIEND_ZAN("好友定时点赞", "给选中的好友名片点赞", "好友点赞", "friends", null, false, "0 0 0 * * *"),
    FRIEND_MSG("好友定时续火花", "给选中的好友定时发消息", "好友续火花", "friends", "message", false, "0 0 8 * * *"),
    GROUP_CLOCK("群聊定时打卡", "给选中的群聊打卡", "群打卡", "groups", null, true, "0 0 8 * * *"),
    GROUP_MSG("群聊定时续火花", "给选中的群聊定时发消息", "群组续火", "groups", "message", true, "0 0 8 * * *");

    val envPrefix: String get() = "${AdEngine.resolveTaskId(taskId)}#${Const.ENV_VARIABLE}#"

    companion object {
        fun of(taskId: String?): Preset? = entries.firstOrNull { it.taskId == taskId }
    }
}

private data class Target(val id: String, val label: String)

class AdScheduleActivity : BaseComposeActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            QLsuTheme(isDarkTheme) {
                luo.qlsu.ui.luosu.LuoSuGlassRoot { AdScheduleScreen(onBack = { finish() }) }
            }
        }
    }
}

@Composable
fun AdScheduleScreen(onBack: () -> Unit) {
    val colors = QLsuTheme.colors
    var refresh by remember { mutableIntStateOf(0) }
    var friends by remember { mutableStateOf<List<Target>>(emptyList()) }
    var groups by remember { mutableStateOf<List<Target>>(emptyList()) }

    // add flow
    var step by remember { mutableStateOf(0) } // 0 none, 1 preset, 2 target, 3 config
    var preset by remember { mutableStateOf<Preset?>(null) }
    var selectedTargets by remember { mutableStateOf<Set<String>>(emptySet()) }
    var cronText by remember { mutableStateOf("") }
    var msgText by remember { mutableStateOf("") }

    LaunchedEffect(Unit) {
        withContext(Dispatchers.IO) {
            friends = runCatching {
                FriendTool.getAllFriend().map { Target(it.uin, it.remark.ifBlank { it.name }) }
            }.getOrDefault(emptyList())
            groups = runCatching {
                TroopTool.getGroupList().map { Target(it.group, it.groupName.ifBlank { it.group }) }
            }.getOrDefault(emptyList())
        }
    }

    val tick = refresh
    val conf = remember(tick) { runCatching { ConfigUtil.loadSaveConf() }.getOrNull() }
    val taskMap = remember(tick) {
        conf?.taskGroups.orEmpty().flatMap { it.tasks }.associateBy { it.id }
    }
    val scheduled = remember(tick) { ScheduledTaskStore.list() }
    val labels = remember(friends, groups) { (friends + groups).associate { it.id to it.label } }

    fun targetText(p: Preset): String {
        val raw = accountConfig.getString(p.envPrefix + p.targetEnv).orEmpty()
        val ids = raw.split(",").filter { it.isNotBlank() }
        if (ids.isEmpty()) return "未选择"
        return ids.map { labels[it] ?: it }.joinToString("、")
    }

    fun save(p: Preset, targets: Set<String>, cron: String, msg: String) {
        accountConfig.putString(p.envPrefix + p.targetEnv, targets.joinToString(","))
        p.messageEnv?.let { accountConfig.putString(p.envPrefix + it, msg) }
        if (ScheduledTaskStore.find(p.taskId) == null) {
            ScheduledTaskStore.add(p.taskId, cron)
        } else {
            ScheduledTaskStore.setCron(p.taskId, cron)
            ScheduledTaskStore.setEnabled(p.taskId, true)
        }
        taskMap[p.taskId]?.nextShouldExecTime = null
        refresh++
    }

    BackHandler { onBack() }

    Box(
        modifier = Modifier
            .fillMaxSize()
            .background(Color.Transparent)
            .windowInsetsPadding(WindowInsets.statusBars)
    ) {
        Column(Modifier.fillMaxSize()) {
            Row(
                modifier = Modifier
                    .fillMaxWidth()
                    .padding(horizontal = 12.dp, vertical = 8.dp),
                verticalAlignment = Alignment.CenterVertically
            ) {
                GlassBackButton(onClick = onBack)

                Spacer(Modifier.width(12.dp))
                Column(Modifier.weight(1f)) {
                    Text("定时任务", fontSize = 20.sp, fontWeight = FontWeight.Bold, color = colors.textPrimary)
                    Text(
                        "好友点赞 / 续火 · 群打卡 / 群续火 · 已添加 ${scheduled.size}",
                        fontSize = 10.sp,
                        color = colors.textSecondary
                    )
                }

                Box(
                    modifier = Modifier
                        .clip(RoundedCornerShape(12.dp))
                        .background(Brush.linearGradient(listOf(Color(0xFFE9497E), Color(0xFFF07AA0))))
                        .pressClick {
                            preset = null
                            selectedTargets = emptySet()
                            cronText = ""
                            msgText = ""
                            step = 1
                        }
                        .padding(horizontal = 16.dp, vertical = 9.dp)
                ) { Text("添加任务", fontSize = 12.sp, color = Color.White) }
            }

            if (scheduled.isEmpty()) {
                EmptyState(onAdd = { step = 1 })
            } else {
                LazyColumn(
                    modifier = Modifier.fillMaxSize(),
                    contentPadding = androidx.compose.foundation.layout.PaddingValues(16.dp, 6.dp, 16.dp, 24.dp),
                    verticalArrangement = Arrangement.spacedBy(10.dp)
                ) {
                    items(scheduled, key = { it.id }) { item ->
                        val p = Preset.of(item.id) ?: return@items
                        ScheduledTaskCard(
                            scheduled = item,
                            preset = p,
                            targets = targetText(p),
                            message = accountConfig.getString(p.envPrefix + (p.messageEnv ?: "")) ?: "",
                            next = taskMap[p.taskId]?.let { runCatching { it.nextShouldExecTime }.getOrNull() },
                            onToggle = { enabled ->
                                ScheduledTaskStore.setEnabled(item.id, enabled)
                                taskMap[p.taskId]?.nextShouldExecTime = null
                                refresh++
                            },
                            onRun = {
                                val targetsRaw = accountConfig.getString(p.envPrefix + p.targetEnv).orEmpty()
                                if (targetsRaw.isBlank()) {
                                    ToastUtil.send("请先选择${if (p.isGroup) "群聊" else "好友"}")
                                } else {
                                    ToastUtil.send("正在执行：${p.title}")
                                    AdEngine.runTask(p.taskId) { ok, msg ->
                                        ToastUtil.send(if (ok) "已执行：${p.title}" else "执行失败：$msg")
                                    }
                                }
                            },
                            onEdit = {
                                preset = p
                                selectedTargets = (accountConfig.getString(p.envPrefix + p.targetEnv) ?: "")
                                    .split(",").filter { it.isNotBlank() }.toSet()
                                cronText = item.cron.ifBlank { p.defaultCron }
                                msgText = accountConfig.getString(p.envPrefix + (p.messageEnv ?: "")) ?: ""
                                step = 2
                            },
                            onDelete = {
                                ScheduledTaskStore.remove(item.id)
                                ToastUtil.send("已移除：${p.title}")
                                refresh++
                            }
                        )
                    }
                }
            }
        }
    }

    // 1. 选任务类型
    if (step == 1) {
        AlertDialog(
            onDismissRequest = { step = 0 },
            title = { Text("选择任务类型") },
            text = {
                Column(verticalArrangement = Arrangement.spacedBy(8.dp)) {
                    Preset.entries.forEach { p ->
                        Row(
                            Modifier
                                .fillMaxWidth()
                                .clip(RoundedCornerShape(10.dp))
                                .glassSurface(RoundedCornerShape(10.dp))
                                .pressClick {
                                    preset = p
                                    selectedTargets = emptySet()
                                    cronText = p.defaultCron
                                    msgText = ""
                                    step = 2
                                }
                                .padding(12.dp)
                        ) {
                            Column {
                                Text(p.title, fontSize = 14.sp, color = colors.textPrimary)
                                Text(p.desc, fontSize = 10.sp, color = colors.textSecondary)
                            }
                        }
                    }
                }
            },
            confirmButton = { TextButton(onClick = { step = 0 }) { Text("取消") } }
        )
    }

    // 2. 选好友/群
    if (step == 2) {
        val p = preset
        if (p != null) {
            TargetPickerDialog(
                title = if (p.isGroup) "选择群聊" else "选择好友",
                targets = if (p.isGroup) groups else friends,
                selected = selectedTargets,
                onSelectionChange = { selectedTargets = it },
                onDismiss = { step = 0 },
                onConfirm = { step = 3 }
            )
        }
    }

    // 3. 定时/文案
    if (step == 3) {
        val p = preset
        if (p != null) {
            ConfigDialog(
                preset = p,
                cron = cronText,
                message = msgText,
                onCronChange = { cronText = it },
                onMessageChange = { msgText = it },
                onDismiss = { step = 0 },
                onConfirm = {
                    if (selectedTargets.isEmpty()) {
                        ToastUtil.send("请先选择${if (p.isGroup) "群聊" else "好友"}")
                    } else {
                        save(p, selectedTargets, cronText.trim().ifBlank { p.defaultCron }, msgText.trim())
                        ToastUtil.send("已添加：${p.title}")
                        step = 0
                    }
                }
            )
        }
    }
}

@Composable
private fun EmptyState(onAdd: () -> Unit) {
    val colors = QLsuTheme.colors
    Column(
        modifier = Modifier
            .fillMaxSize()
            .padding(32.dp),
        horizontalAlignment = Alignment.CenterHorizontally,
        verticalArrangement = Arrangement.Center
    ) {
        Text("还没有定时任务", fontSize = 16.sp, color = colors.textPrimary)
        Spacer(Modifier.height(6.dp))
        Text(
            "支持：好友定时点赞、好友定时续火、群聊定时打卡、群聊定时续火\n" +
                    "点右上角「添加任务」→ 选类型 → 选好友/群 → 设时间",
            fontSize = 11.sp,
            color = colors.textSecondary,
            textAlign = androidx.compose.ui.text.style.TextAlign.Center,
            lineHeight = 18.sp
        )
        Spacer(Modifier.height(16.dp))
        Box(
            modifier = Modifier
                .clip(RoundedCornerShape(12.dp))
                .background(colors.accentBlue)
                .pressClick(onClick = onAdd)
                .padding(horizontal = 20.dp, vertical = 10.dp)
        ) { Text("添加任务", color = Color.White, fontSize = 13.sp) }
    }
}

@Composable
private fun ScheduledTaskCard(
    scheduled: ScheduledTask,
    preset: Preset,
    targets: String,
    message: String,
    next: String?,
    onToggle: (Boolean) -> Unit,
    onRun: () -> Unit,
    onEdit: () -> Unit,
    onDelete: () -> Unit,
) {
    val colors = QLsuTheme.colors
    Column(
        modifier = Modifier
            .fillMaxWidth()
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .padding(14.dp)
    ) {
        Row(verticalAlignment = Alignment.CenterVertically) {
            Column(Modifier.weight(1f)) {
                Text(preset.title, fontSize = 15.sp, fontWeight = FontWeight.Medium, color = colors.textPrimary)
                Text(
                    preset.desc,
                    fontSize = 10.sp,
                    color = colors.textSecondary
                )
            }
            QLsuSwitch(checked = scheduled.enabled, onCheckedChange = onToggle)
        }
        Spacer(Modifier.height(6.dp))
        Text("对象：$targets", fontSize = 11.sp, color = colors.textPrimary, maxLines = 2)
        if (preset.messageEnv != null && message.isNotBlank()) {
            Text("内容：$message", fontSize = 10.sp, color = colors.textSecondary, maxLines = 2)
        }
        Text(
            buildString {
                run {
                    val parts = scheduled.cron.ifBlank { preset.defaultCron }.split(" ")
                    val h = parts.getOrNull(2)?.toIntOrNull() ?: 0
                    val m = parts.getOrNull(1)?.toIntOrNull() ?: 0
                    append("每天 ").append("%02d:%02d".format(h, m))
                }
                if (!next.isNullOrBlank()) append("  ·  下次 ").append(next)
            },
            fontSize = 10.sp,
            color = colors.textSecondary
        )
        Spacer(Modifier.height(8.dp))
        Row(horizontalArrangement = Arrangement.spacedBy(4.dp)) {
            SmallAction("修改", onEdit)
            SmallAction("立即", onRun)
            SmallAction("删除", onDelete, danger = true)
        }
    }
}

@Composable
private fun SmallAction(text: String, onClick: () -> Unit, danger: Boolean = false) {
    val colors = QLsuTheme.colors
    Box(
        modifier = Modifier
            .clip(RoundedCornerShape(999.dp))
            .background(if (danger) colors.accentRed.copy(alpha = 0.08f) else colors.accentBlue.copy(alpha = 0.10f))
            .pressClick(onClick = onClick)
            .padding(horizontal = 12.dp, vertical = 6.dp)
    ) {
        Text(text, fontSize = 11.sp, color = if (danger) colors.accentRed else colors.accentBlue)
    }
}

@Composable
private fun TargetPickerDialog(
    title: String,
    targets: List<Target>,
    selected: Set<String>,
    onSelectionChange: (Set<String>) -> Unit,
    onDismiss: () -> Unit,
    onConfirm: () -> Unit,
) {
    val colors = QLsuTheme.colors
    var query by remember { mutableStateOf("") }
    var local by remember { mutableStateOf(selected) }
    val filtered = remember(query, targets) {
        if (query.isBlank()) targets
        else targets.filter { it.id.contains(query) || it.label.contains(query, true) }
    }

    AlertDialog(
        onDismissRequest = onDismiss,
        title = { Text(title + if (targets.isEmpty()) "（列表为空）" else "") },
        text = {
            Column {
                Box(
                    modifier = Modifier
                        .fillMaxWidth()
                        .clip(RoundedCornerShape(10.dp))
                        .glassSurface(RoundedCornerShape(10.dp))
                        .padding(horizontal = 12.dp, vertical = 10.dp)
                ) {
                    if (query.isEmpty()) Text("搜索", fontSize = 12.sp, color = colors.textSecondary)
                    BasicTextField(
                        value = query,
                        onValueChange = { query = it },
                        singleLine = true,
                        textStyle = TextStyle(fontSize = 13.sp, color = colors.textPrimary),
                        modifier = Modifier.fillMaxWidth()
                    )
                }
                Spacer(Modifier.height(8.dp))
                Row(horizontalArrangement = Arrangement.spacedBy(6.dp)) {
                    SmallAction("全选", onClick = { local = local + filtered.map { it.id }.toSet() })
                    SmallAction("反选", onClick = {
                        val ids = filtered.map { it.id }.toSet()
                        local = (local - ids) + (ids - local)
                    })
                    SmallAction("清空", onClick = { local = emptySet() })
                }
                Spacer(Modifier.height(6.dp))
                LazyColumn(Modifier.height(300.dp)) {
                    items(filtered, key = { it.id }) { t ->
                        val checked = t.id in local
                        Row(
                            Modifier
                                .fillMaxWidth()
                                .pressClick {
                                    local = if (checked) local - t.id else local + t.id
                                }
                                .padding(vertical = 8.dp, horizontal = 4.dp),
                            verticalAlignment = Alignment.CenterVertically
                        ) {
                            Box(
                                Modifier
                                    .size(18.dp)
                                    .clip(CircleShape)
                                    .background(if (checked) colors.accentBlue else Color.Transparent)
                                    .border(1.dp, colors.border, CircleShape)
                            )
                            Spacer(Modifier.width(10.dp))
                            Column {
                                Text(t.label, fontSize = 14.sp, color = colors.textPrimary)
                                Text(t.id, fontSize = 10.sp, color = colors.textSecondary)
                            }
                        }
                    }
                }
            }
        },
        confirmButton = {
            TextButton(onClick = {
                onSelectionChange(local)
                onConfirm()
            }) { Text("确定(${local.size})") }
        },
        dismissButton = { TextButton(onClick = onDismiss) { Text("取消") } }
    )
}

@Composable
private fun ConfigDialog(
    preset: Preset,
    cron: String,
    message: String,
    onCronChange: (String) -> Unit,
    onMessageChange: (String) -> Unit,
    onDismiss: () -> Unit,
    onConfirm: () -> Unit,
) {
    val colors = QLsuTheme.colors
    val parts = remember(cron) { cron.trim().split(" ").filter { it.isNotBlank() } }
    var hour by remember(cron) { mutableIntStateOf(parts.getOrNull(2)?.toIntOrNull() ?: 8) }
    var minute by remember(cron) { mutableIntStateOf(parts.getOrNull(1)?.toIntOrNull() ?: 0) }
    var picking by remember { mutableStateOf<String?>(null) }

    fun emit() {
        onCronChange("0 %d %d * * *".format(minute, hour))
    }

    AlertDialog(
        onDismissRequest = onDismiss,
        title = { Text("设置 · ${preset.title}") },
        text = {
            Column {
                Text("执行时间", fontSize = 11.sp, color = colors.textSecondary)
                Spacer(Modifier.height(8.dp))
                Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                    TimeChip("%02d".format(hour), "时") { picking = "hour" }
                    TimeChip("%02d".format(minute), "分") { picking = "minute" }
                }
                if (preset.messageEnv != null) {
                    Spacer(Modifier.height(10.dp))
                    OutlinedTextField(
                        value = message,
                        onValueChange = onMessageChange,
                        label = { Text("发送内容（多个用 | 分隔随机）") },
                        modifier = Modifier.fillMaxWidth()
                    )
                }
            }
        },
        confirmButton = {
            TextButton(onClick = {
                emit()
                onConfirm()
            }) { Text("保存") }
        },
        dismissButton = { TextButton(onClick = onDismiss) { Text("取消") } }
    )

    when (picking) {
        "hour" -> NumberPickerDialog("选择小时", 0..23, hour, onDismiss = { picking = null }) {
            hour = it; emit()
        }
        "minute" -> NumberPickerDialog("选择分钟", 0..59, minute, onDismiss = { picking = null }) {
            minute = it; emit()
        }
    }
}

@Composable
private fun TimeChip(value: String, unit: String, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Row(
        modifier = Modifier
            .glassSurface(RoundedCornerShape(12.dp), tintAlpha = 0.9f)
            .pressClick(onClick = onClick)
            .padding(horizontal = 14.dp, vertical = 10.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Text(value, fontSize = 18.sp, fontWeight = FontWeight.SemiBold, color = colors.textPrimary)
        Spacer(Modifier.width(4.dp))
        Text(unit, fontSize = 10.sp, color = colors.textSecondary)
    }
}

@Composable
private fun NumberPickerDialog(
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
                    Row(
                        Modifier
                            .fillMaxWidth()
                            .pressClick {
                                onPick(n)
                                onDismiss()
                            }
                            .padding(vertical = 10.dp, horizontal = 8.dp),
                        verticalAlignment = Alignment.CenterVertically
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