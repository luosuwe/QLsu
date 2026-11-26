package luo.qlsu.ui.pages.home

import androidx.compose.foundation.Image
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.WindowInsets
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.statusBars
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.layout.windowInsetsPadding
import androidx.compose.foundation.rememberScrollState
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.foundation.verticalScroll
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.asImageBitmap
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.res.painterResource
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import luo.qlsu.R
import luo.qlsu.account.AccountInfo
import luo.qlsu.ui.components.atoms.QLsuSwitch
import luo.qlsu.ui.core.theme.Dimens
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.ui.luosu.glassSurface
import luo.qlsu.ui.luosu.pressClick

/**
 * 模块自身 App 的首页（洛苏风格）。
 * 真正的设置/定时任务页面运行在 QQ 进程内，这里只负责唤起它。
 *
 * 头像 / 用户中心：QQ 号由 QQ 进程同步到本地后，点击头像会换取一次性票据，
 * 浏览器打开已登录的 qlsu.luosu.top 用户中心。
 */
@Composable
fun LuoSuLauncherScreen(
    versionName: String,
    versionCode: Int,
    isActivated: Boolean,
    frameworkInfo: String,
    account: AccountInfo?,
    motionEnabled: Boolean,
    onUserCenterClick: () -> Unit,
    onMotionToggle: (Boolean) -> Unit,
    onOpenSettings: () -> Unit,
    onOpenSchedule: () -> Unit,
    onGithubClick: () -> Unit,
    onTelegramClick: () -> Unit,
    onGroupClick: () -> Unit,
    onWebsiteClick: () -> Unit,
) {
    val colors = QLsuTheme.colors

    Box(
        modifier = Modifier
            .fillMaxSize()
            .background(Color.Transparent)
            .windowInsetsPadding(WindowInsets.statusBars)
    ) {
        Column(
            modifier = Modifier
                .fillMaxSize()
                .verticalScroll(rememberScrollState())
                .padding(18.dp),
            verticalArrangement = Arrangement.spacedBy(12.dp)
        ) {
            // ---------- 顶栏：品牌 + 头像 ----------
            Row(
                modifier = Modifier.fillMaxWidth(),
                verticalAlignment = Alignment.CenterVertically
            ) {
                Image(
                    painter = painterResource(R.drawable.ic_launcher),
                    contentDescription = null,
                    modifier = Modifier
                        .height(40.dp)
                        .clip(RoundedCornerShape(10.dp))
                )
                Column(Modifier.padding(start = 10.dp).weight(1f)) {
                    Text("QLsu", fontSize = 22.sp, fontWeight = FontWeight.Bold, color = colors.textPrimary)
                    Text(
                        "v$versionName ($versionCode)",
                        fontSize = 10.sp,
                        color = colors.textSecondary
                    )
                }
            }

            // ---------- 主视觉 ----------
            Box(
                modifier = Modifier
                    .fillMaxWidth()
                    .glassSurface(RoundedCornerShape(Dimens.CardCornerRadiusLarge))
                    .padding(18.dp)
            ) {
                Column {
                    Text("QQ / TIM 多功能模块", fontSize = 18.sp, fontWeight = FontWeight.Bold, color = colors.textPrimary)
                    Spacer(Modifier.height(4.dp))
                    Text(
                        "多功能 + 独立定时任务 · 洛苏 UI",
                        fontSize = 12.sp,
                        color = colors.textSecondary
                    )
                    Spacer(Modifier.height(12.dp))
                    Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                        StatusPill(if (isActivated) "已激活" else "未激活")
                        StatusPill(if (account != null && account.isReady) "账号已同步" else "账号待同步")
                    }
                }
            }

            // ---------- 账号卡 ----------
            AccountCard(account = account, onUserCenterClick = onUserCenterClick)

            Text(
                if (frameworkInfo.isBlank()) "LSPosed 作用域：com.tencent.mobileqq / com.tencent.tim"
                else frameworkInfo.replace("\n", " "),
                fontSize = 10.sp,
                color = colors.textSecondary
            )

            QuickEntriesCard(
                onUserCenter = onUserCenterClick,
                onSettings = onOpenSettings,
                onSchedule = onOpenSchedule,
            )

            // ---------- 界面动画开关 ----------
            Row(
                modifier = Modifier
                    .fillMaxWidth()
                    .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
                    .padding(horizontal = 16.dp, vertical = 12.dp),
                verticalAlignment = Alignment.CenterVertically
            ) {
                Column(Modifier.weight(1f)) {
                    Text("界面过渡动画", fontSize = 14.sp, fontWeight = FontWeight.SemiBold, color = colors.textPrimary)
                    Text(
                        if (motionEnabled) "开关页面时播放进入 / 返回动画" else "关闭：切换页面不播放进入 / 返回动画",
                        fontSize = 11.sp,
                        color = colors.textSecondary
                    )
                }
                QLsuSwitch(checked = motionEnabled, onCheckedChange = onMotionToggle)
            }

            SecondaryButton("官网下载 qlsu.luosu.top", onWebsiteClick)

            Text(
                "设置与定时任务都在 QQ 进程内运行，因此会先唤起 QQ；不会修改 QQ 的按钮或布局。",
                fontSize = 11.sp,
                color = colors.textSecondary,
                lineHeight = 17.sp
            )

            Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                LinkPill("GitHub", onGithubClick)
                LinkPill("Telegram", onTelegramClick)
                LinkPill("Q群", onGroupClick)
            }
        }
    }
}

@Composable
private fun QuickEntriesCard(
    onUserCenter: () -> Unit,
    onSettings: () -> Unit,
    onSchedule: () -> Unit,
) {
    val colors = QLsuTheme.colors
    Column(
        modifier = Modifier
            .fillMaxWidth()
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .padding(vertical = 4.dp)
    ) {
        QuickRow("打开用户中心", true, onUserCenter)
        QuickDivider()
        QuickRow("打开 QLsu 设置", false, onSettings)
        QuickDivider()
        QuickRow("定时任务", false, onSchedule)
        QuickDivider()
    }
}

@Composable
private fun QuickRow(text: String, highlight: Boolean, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .pressClick(onClick = onClick)
            .padding(horizontal = 16.dp, vertical = 15.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Text(
            text,
            modifier = Modifier.weight(1f),
            fontSize = 15.sp,
            fontWeight = if (highlight) FontWeight.SemiBold else FontWeight.Normal,
            color = if (highlight) Color(0xFFE9497E) else colors.textPrimary
        )
        Text("›", fontSize = 18.sp, color = colors.textSecondary)
    }
}

@Composable
private fun QuickDivider() {
    Box(
        modifier = Modifier
            .fillMaxWidth()
            .padding(start = 16.dp)
            .height(1.dp)
            .background(Color(0x11000000))
    )
}

@Composable
private fun AccountAvatar(account: AccountInfo?, onClick: () -> Unit) {
    val initials = account?.initials ?: "QL"
    Box(
        modifier = Modifier
            .size(44.dp)
            .clip(CircleShape)
            .background(
                if (account != null && account.isReady) {
                    Brush.linearGradient(listOf(Color(0xFFE9497E), Color(0xFFF7A8C2)))
                } else {
                    Brush.linearGradient(listOf(Color(0xFFB9B9C3), Color(0xFFD9D9E0)))
                }
            )
            .pressClick(onClick = onClick),
        contentAlignment = Alignment.Center
    ) {
        Text(initials, fontSize = 13.sp, fontWeight = FontWeight.Bold, color = Color.White)
    }
}

@Composable
private fun AccountCard(account: AccountInfo?, onUserCenterClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Box(
        modifier = Modifier
            .fillMaxWidth()
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .pressClick(onClick = onUserCenterClick)
            .padding(16.dp)
    ) {
        Row(verticalAlignment = Alignment.CenterVertically) {
            Box(
                modifier = Modifier
                    .size(40.dp)
                    .clip(CircleShape)
                    .background(
                        Brush.linearGradient(listOf(Color(0xFFE9497E), Color(0xFFF7A8C2)))
                    ),
                contentAlignment = Alignment.Center
            ) {
                QqAvatar(account?.uin.orEmpty(), Modifier.matchParentSize())
            }
            Spacer(Modifier.width(12.dp))
            Column(Modifier.weight(1f)) {
                Text(
                    if (account == null) "还没有同步 QQ 账号" else "QQ ${account.uin}",
                    fontSize = 15.sp,
                    fontWeight = FontWeight.SemiBold,
                    color = colors.textPrimary
                )
                Spacer(Modifier.height(3.dp))
                Text(
                    when {
                        account == null -> "在 QQ 里激活模块后自动注册，点头像即可进入用户中心"
                        account.nick.isNotBlank() -> "${account.nick} · 点击进入用户中心"
                        account.isReady -> "点击进入用户中心（自动登录）"
                        else -> "等待下一次同步"
                    },
                    fontSize = 11.sp,
                    color = colors.textSecondary
                )
            }
            Text("进入 →", fontSize = 13.sp, fontWeight = FontWeight.SemiBold, color = Color(0xFFE9497E))
        }
    }
}

@Composable
private fun PrimaryButton(text: String, onClick: () -> Unit) {
    Box(
        modifier = Modifier
            .fillMaxWidth()
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .background(Brush.linearGradient(listOf(Color(0xFFE9497E), Color(0xFFF07AA0))))
            .pressClick(onClick = onClick)
            .padding(vertical = 14.dp),
        contentAlignment = Alignment.Center
    ) {
        Text(text, fontSize = 15.sp, fontWeight = FontWeight.SemiBold, color = Color.White)
    }
}

@Composable
private fun SecondaryButton(text: String, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Box(
        modifier = Modifier
            .fillMaxWidth()
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .pressClick(onClick = onClick)
            .padding(vertical = 14.dp),
        contentAlignment = Alignment.Center
    ) {
        Text(text, fontSize = 14.sp, color = colors.textPrimary)
    }
}

@Composable
private fun StatusPill(text: String) {
    Box(
        modifier = Modifier
            .clip(RoundedCornerShape(999.dp))
            .background(Color.White.copy(alpha = 0.18f))
            .padding(horizontal = 10.dp, vertical = 5.dp)
    ) {
        Text(text, fontSize = 10.sp, color = Color.White)
    }
}

@Composable
private fun LinkPill(text: String, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Box(
        modifier = Modifier
            .clip(RoundedCornerShape(999.dp))
            .glassSurface(RoundedCornerShape(999.dp))
            .pressClick(onClick = onClick)
            .padding(horizontal = 14.dp, vertical = 7.dp)
    ) {
        Text(text, fontSize = 11.sp, color = colors.textPrimary)
    }
}


@Composable
private fun QqAvatar(uin: String, modifier: Modifier = Modifier) {
    val ctx = androidx.compose.ui.platform.LocalContext.current
    val bmp by androidx.compose.runtime.produceState<androidx.compose.ui.graphics.ImageBitmap?>(
        initialValue = null, uin
    ) {
        if (uin.isBlank()) return@produceState
        value = kotlinx.coroutines.withContext(kotlinx.coroutines.Dispatchers.IO) {
            runCatching {
                val conn = (java.net.URL("https://q1.qlogo.cn/g?b=qq&nk=$uin&s=160").openConnection() as java.net.HttpURLConnection).apply {
                    connectTimeout = 8000
                    readTimeout = 12000
                    setRequestProperty("User-Agent", "Mozilla/5.0 (Linux; Android 13)")
                }
                val bytes = conn.inputStream.use { it.readBytes() }
                android.graphics.BitmapFactory.decodeByteArray(bytes, 0, bytes.size)
                    ?.asImageBitmap()
            }.getOrNull()
        }
    }
    if (bmp != null) {
        Image(bitmap = bmp!!, contentDescription = null, modifier = modifier, contentScale = ContentScale.Crop)
    }
}
