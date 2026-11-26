package luo.qlsu.ui.pages.settings

import androidx.activity.compose.BackHandler
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
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.statusBars
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.layout.windowInsetsPadding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.foundation.text.BasicTextField
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
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
import luo.qlsu.R
import luo.qlsu.ui.components.atoms.QLsuSwitch
import luo.qlsu.ui.components.dialogs.CenterDialog
import luo.qlsu.ui.core.theme.Dimens
import luo.qlsu.ui.luosu.GlassBackButton
import luo.qlsu.ui.luosu.GlassIconButton
import luo.qlsu.ui.luosu.glassSurface
import luo.qlsu.ui.luosu.pressClick
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.ui.pages.configs.ConfigUiRegistry
import luo.qlsu.ui.viewmodel.UpdateLogState
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.foundation.layout.size
import androidx.compose.ui.graphics.asImageBitmap
import androidx.compose.ui.layout.ContentScale
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import androidx.compose.animation.togetherWith
import androidx.compose.foundation.Image
import androidx.compose.ui.res.painterResource

/**
 * 洛苏风格设置页：白/黑底、12dp 圆角卡片、粉色主色、霞鹜文楷字体。
 * 布局刻意区别于 QFun：品牌头 + 搜索 + Hero 卡 + 快捷入口 + 分类双列 + 关于。
 */
@Composable
fun LuoSuSettingsScreen(
    categories: List<CategoryData>,
    searchResults: List<Pair<FunctionData, String>>,
    searchQuery: String,
    onQueryChange: (String) -> Unit,
    isSearchActive: Boolean,
    onSearchActiveChange: (Boolean) -> Unit,
    versionInfo: String,
    themeMode: Int,
    isDarkTheme: Boolean,
    onThemeToggle: () -> Unit,
    onImportConfig: () -> Unit,
    onExportConfig: () -> Unit,
    onFunctionToggle: (String, Boolean) -> Unit,
    onFunctionClick: (String) -> Unit,
    onGithubClick: () -> Unit,
    onTelegramClick: () -> Unit,
    onGroupClick: () -> Unit,
    onDonateClick: () -> Unit,
    onScheduleClick: () -> Unit,
    activeConfigKey: String?,
    onDismissDialog: () -> Unit,
    showUpdateLogDialog: Boolean,
    updateLogState: UpdateLogState,
    onUpdateLogClick: () -> Unit,
    onDismissUpdateLog: () -> Unit,
    isNeedRestart: Boolean,
    onRestartStateChange: () -> Unit,
    onBackClick: () -> Unit,
    modifier: Modifier = Modifier,
) {
    val colors = QLsuTheme.colors
    var selectedCategoryName by remember { mutableStateOf<String?>(null) }
    val selectedCategory = categories.firstOrNull { it.name == selectedCategoryName }

    val handleBack = {
        when {
            activeConfigKey != null -> onDismissDialog()
            isSearchActive -> onSearchActiveChange(false)
            selectedCategoryName != null -> selectedCategoryName = null
            else -> onBackClick()
        }
    }
    BackHandler(onBack = handleBack)

    Box(
        modifier = modifier
            .fillMaxSize()
            .background(Color.Transparent)
            .windowInsetsPadding(WindowInsets.statusBars)
    ) {
        luo.qlsu.ui.Wallpaper.WallpaperLayer()
        Column(modifier = Modifier.fillMaxSize()) {
            BrandHeader(
                versionInfo = versionInfo,
                isDarkTheme = isDarkTheme,
                onThemeToggle = onThemeToggle,
                isSearchActive = isSearchActive,
                onToggleSearch = { onSearchActiveChange(!isSearchActive) }
            )

            androidx.compose.animation.AnimatedContent(
                targetState = selectedCategory,
                transitionSpec = {
                    (androidx.compose.animation.fadeIn(androidx.compose.animation.core.tween(220)) +
                            androidx.compose.animation.slideInHorizontally(androidx.compose.animation.core.tween(260)) { it / 10 }) togetherWith
                            (androidx.compose.animation.fadeOut(androidx.compose.animation.core.tween(150)) +
                                    androidx.compose.animation.slideOutHorizontally(androidx.compose.animation.core.tween(200)) { -it / 12 })
                },
                label = "settingsContent"
            ) { category ->
                when {
                    category != null -> CategoryDetail(
                        category = category,
                        onBack = { selectedCategoryName = null },
                        onFunctionToggle = onFunctionToggle,
                        onFunctionClick = onFunctionClick
                    )

                    else -> HomeContent(
                        categories = categories,
                        versionInfo = versionInfo,
                        searchResults = searchResults,
                        searchQuery = searchQuery,
                        isSearchActive = isSearchActive,
                        onQueryChange = onQueryChange,
                        onFunctionToggle = onFunctionToggle,
                        onFunctionClick = onFunctionClick,
                        onCategoryClick = { selectedCategoryName = it.name },
                        onScheduleClick = onScheduleClick,
                        onGithubClick = onGithubClick,
                        onTelegramClick = onTelegramClick,
                        onGroupClick = onGroupClick,
                        onDonateClick = onDonateClick
                    )
                }
            }
        }

        val configUi = activeConfigKey?.let { ConfigUiRegistry.getConfigUi(it) }
        CenterDialog(visible = activeConfigKey != null && configUi != null, onDismiss = onDismissDialog) {
            configUi?.invoke(onDismissDialog)
        }
    }
}

@Composable
private fun AccountAvatar(uin: String, size: Int = 34) {
    val colors = QLsuTheme.colors
    var bitmap by remember(uin) { mutableStateOf<androidx.compose.ui.graphics.ImageBitmap?>(null) }
    LaunchedEffect(uin) {
        if (uin.isNotBlank()) {
            bitmap = withContext(Dispatchers.IO) {
                runCatching {
                    val conn = java.net.URL("https://q1.qlogo.cn/g?b=qq&nk=$uin&s=100").openConnection() as java.net.HttpURLConnection
                    conn.connectTimeout = 4000
                    conn.readTimeout = 4000
                    conn.inputStream.use { android.graphics.BitmapFactory.decodeStream(it)?.asImageBitmap() }
                }.getOrNull()
            }
        }
    }
    Box(
        modifier = Modifier
            .size(size.dp)
            .clip(CircleShape)
            .background(colors.border),
        contentAlignment = Alignment.Center
    ) {
        val bmp = bitmap
        if (bmp != null) {
            Image(bitmap = bmp, contentDescription = null, modifier = Modifier.fillMaxSize())
        } else {
            Text("Q", fontSize = 14.sp, color = colors.textSecondary)
        }
    }
}

@Composable
private fun BrandHeader(
    versionInfo: String,
    isDarkTheme: Boolean,
    onThemeToggle: () -> Unit,
    isSearchActive: Boolean,
    onToggleSearch: () -> Unit,
) {
    val colors = QLsuTheme.colors
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .padding(horizontal = 16.dp, vertical = 10.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Image(
            painter = painterResource(R.drawable.ic_launcher),
            contentDescription = null,
            modifier = Modifier
                .width(34.dp)
                .height(34.dp)
                .clip(RoundedCornerShape(9.dp))
        )
        Spacer(Modifier.width(10.dp))
        Column(modifier = Modifier.weight(1f)) {
            val uin = runCatching { luo.qlsu.utils.qq.QQCurrentEnv.currentUin }.getOrDefault("")
            val nick = runCatching { luo.qlsu.utils.qq.QQCurrentEnv.currentNickName }.getOrNull()
            Text(
                if (uin.isBlank()) "未登录" else (nick?.takeIf { it.isNotBlank() } ?: "QQ $uin"),
                fontSize = 16.sp,
                fontWeight = FontWeight.Bold,
                color = colors.textPrimary,
                maxLines = 1
            )
            Text(
                if (uin.isBlank()) "QLsu" else "QQ $uin · v${luo.qlsu.BuildConfig.VERSION_NAME}",
                fontSize = 10.sp,
                color = colors.textSecondary,
                maxLines = 1
            )
        }
        luo.qlsu.ui.WallpaperButton()
        Spacer(Modifier.width(8.dp))
        GlassIconButton(
            painter = painterResource(R.drawable.ic_search),
            onClick = onToggleSearch
        )
        Spacer(Modifier.width(8.dp))
        GlassIconButton(
            painter = painterResource(if (isDarkTheme) R.drawable.ic_sun else R.drawable.ic_moon),
            onClick = onThemeToggle
        )
    }
}

@Composable
private fun SearchField(
    query: String,
    onQueryChange: (String) -> Unit,
    modifier: Modifier = Modifier,
) {
    val colors = QLsuTheme.colors
    Box(
        modifier = modifier
            .fillMaxWidth()
            .height(40.dp)
            .clip(RoundedCornerShape(12.dp))
            .glassSurface(RoundedCornerShape(12.dp))
            .padding(horizontal = 14.dp),
        contentAlignment = Alignment.CenterStart
    ) {
        if (query.isEmpty()) {
            Text("搜索功能…", fontSize = 14.sp, color = colors.textSecondary)
        }
        BasicTextField(
            value = query,
            onValueChange = onQueryChange,
            singleLine = true,
            textStyle = TextStyle(fontSize = 14.sp, color = colors.textPrimary),
            modifier = Modifier.fillMaxWidth()
        )
    }
}

@Composable
private fun HomeContent(
    categories: List<CategoryData>,
    versionInfo: String,
    searchResults: List<Pair<FunctionData, String>>,
    searchQuery: String,
    isSearchActive: Boolean,
    onQueryChange: (String) -> Unit,
    onFunctionToggle: (String, Boolean) -> Unit,
    onFunctionClick: (String) -> Unit,
    onCategoryClick: (CategoryData) -> Unit,
    onScheduleClick: () -> Unit,
    onGithubClick: () -> Unit,
    onTelegramClick: () -> Unit,
    onGroupClick: () -> Unit,
    onDonateClick: () -> Unit,
) {
    val colors = QLsuTheme.colors
    val total = categories.sumOf { it.items.size }
    val enabled = categories.sumOf { c -> c.items.count { it.isEnabled } }

    LazyColumn(
        modifier = Modifier.fillMaxSize(),
        contentPadding = androidx.compose.foundation.layout.PaddingValues(16.dp, 4.dp, 16.dp, 24.dp),
        verticalArrangement = Arrangement.spacedBy(12.dp)
    ) {
        if (isSearchActive) {
            item {
                SearchField(query = searchQuery, onQueryChange = onQueryChange)
            }
        }
        if (searchQuery.isNotBlank()) {
            items(searchResults) { (item, _) ->
                FunctionRowLuoSu(
                    item = item,
                    onToggle = { onFunctionToggle(item.id, it) },
                    onClick = if (item.isClickable) ({ onFunctionClick(item.id) }) else null
                )
            }
        } else {
        item {
            AccountPermissionCard()
        }
        item {
            QuickEntryCard(
                title = "定时任务",
                subtitle = "手动添加任务 · 独立 cron · 开关控制定时执行",
                onClick = onScheduleClick
            )
        }
        item {
            Text(
                "功能",
                fontSize = 13.sp,
                fontWeight = FontWeight.SemiBold,
                color = colors.textSecondary,
                modifier = Modifier.padding(top = 6.dp)
            )
        }
        items(categories, key = { it.name }) { category ->
            CategoryCardLuoSu(
                category = category,
                onClick = { onCategoryClick(category) },
                modifier = Modifier.fillMaxWidth()
            )
        }
        item {
            AboutCardLuoSu(
                versionInfo = versionInfo,
                onGithubClick = onGithubClick,
                onTelegramClick = onTelegramClick,
                onGroupClick = onGroupClick,
                onDonateClick = onDonateClick
            )
        }
        }
    }
}

@Composable
private fun HeroCard(total: Int, enabled: Int) {
    val shape = RoundedCornerShape(Dimens.CardCornerRadiusLarge)
    Box(
        modifier = Modifier
            .fillMaxWidth()
            .clip(shape)
            .background(
                Brush.linearGradient(
                    listOf(Color(0xFFE9497E), Color(0xFFF07AA0), Color(0xFFF7A8C2))
                )
            )
            .padding(18.dp)
    ) {
        Column {
            Text("QLsu", fontSize = 26.sp, fontWeight = FontWeight.Bold, color = Color.White)
            Spacer(Modifier.height(4.dp))
            Text(
                "QQ / TIM 功能增强 + 自动签到",
                fontSize = 13.sp,
                color = Color.White.copy(alpha = 0.9f)
            )
            Spacer(Modifier.height(14.dp))
            Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                GlassPill("$total 个功能")
                GlassPill("已开启 $enabled")
                GlassPill("洛苏 UI")
            }
        }
    }
}

@Composable
private fun GlassPill(text: String) {
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
private fun QuickEntryCard(title: String, subtitle: String, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .pressClick(onClick = onClick)
            .padding(16.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Column(modifier = Modifier.weight(1f)) {
            Text(title, fontSize = 16.sp, fontWeight = FontWeight.SemiBold, color = colors.textPrimary)
            Spacer(Modifier.height(3.dp))
            Text(subtitle, fontSize = 11.sp, color = colors.textSecondary)
        }
        Box(
            modifier = Modifier
                .clip(RoundedCornerShape(10.dp))
                .background(colors.accentBlue)
                .padding(horizontal = 14.dp, vertical = 8.dp)
        ) {
            Text("进入", fontSize = 12.sp, color = Color.White)
        }
    }
}

@Composable
private fun CategoryCardLuoSu(category: CategoryData, onClick: () -> Unit, modifier: Modifier = Modifier) {
    val colors = QLsuTheme.colors
    Column(
        modifier = modifier
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .pressClick(onClick = onClick)
            .padding(14.dp)
    ) {
        Text(
            category.name,
            fontSize = 15.sp,
            fontWeight = FontWeight.SemiBold,
            color = colors.textPrimary,
            maxLines = 1
        )
        Spacer(Modifier.height(6.dp))
        Text(
            "${category.items.size} 项 · 开 ${category.items.count { it.isEnabled }}",
            fontSize = 11.sp,
            color = colors.textSecondary
        )
    }
}

@Composable
private fun CategoryDetail(
    category: CategoryData,
    onBack: () -> Unit,
    onFunctionToggle: (String, Boolean) -> Unit,
    onFunctionClick: (String) -> Unit,
) {
    val colors = QLsuTheme.colors
    Column(modifier = Modifier.fillMaxSize()) {
        Row(
            modifier = Modifier
                .fillMaxWidth()
                .padding(horizontal = 8.dp, vertical = 4.dp),
            verticalAlignment = Alignment.CenterVertically
        ) {
            GlassBackButton(onClick = onBack)
            Spacer(Modifier.width(10.dp))
            Text(category.name, fontSize = 18.sp, fontWeight = FontWeight.Bold, color = colors.textPrimary)
        }
        LazyColumn(
            contentPadding = androidx.compose.foundation.layout.PaddingValues(16.dp, 4.dp, 16.dp, 24.dp),
            verticalArrangement = Arrangement.spacedBy(10.dp)
        ) {
            items(category.items, key = { it.id }) { item ->
                FunctionRowLuoSu(
                    item = item,
                    onToggle = { onFunctionToggle(item.id, it) },
                    onClick = if (item.isClickable) ({ onFunctionClick(item.id) }) else null
                )
            }
        }
    }
}

@Composable
private fun FunctionRowLuoSu(item: FunctionData, onToggle: (Boolean) -> Unit, onClick: (() -> Unit)?) {
    val colors = QLsuTheme.colors
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .pressClick(enabled = onClick != null) { onClick?.invoke() }
            .padding(horizontal = 14.dp, vertical = 12.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Column(modifier = Modifier.weight(1f)) {
            Text(item.name, fontSize = 14.sp, color = colors.textPrimary)
            if (item.description.isNotBlank()) {
                Spacer(Modifier.height(2.dp))
                Text(item.description, fontSize = 11.sp, color = colors.textSecondary, maxLines = 2)
            }
        }
        QLsuSwitch(
            checked = item.isEnabled,
            onCheckedChange = onToggle,
            modifier = Modifier.padding(start = 8.dp)
        )
    }
}

@Composable
private fun SearchResults(
    results: List<Pair<FunctionData, String>>,
    query: String,
    onFunctionToggle: (String, Boolean) -> Unit,
    onFunctionClick: (String) -> Unit,
) {
    val colors = QLsuTheme.colors
    if (query.isNotEmpty() && results.isEmpty()) {
        Box(Modifier.fillMaxSize(), contentAlignment = Alignment.Center) {
            Text("没有找到相关功能", color = colors.textSecondary)
        }
        return
    }
    LazyColumn(
        contentPadding = androidx.compose.foundation.layout.PaddingValues(16.dp, 4.dp, 16.dp, 24.dp),
        verticalArrangement = Arrangement.spacedBy(10.dp)
    ) {
        items(results, key = { it.first.id }) { (item, category) ->
            Row(
                modifier = Modifier
                    .fillMaxWidth()
                    .clip(RoundedCornerShape(Dimens.CardCornerRadius))
                    .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
                    .pressClick { onFunctionClick(item.id) }
                    .padding(horizontal = 14.dp, vertical = 12.dp),
                verticalAlignment = Alignment.CenterVertically
            ) {
                Column(modifier = Modifier.weight(1f)) {
                    Text(item.name, fontSize = 14.sp, color = colors.textPrimary)
                    Text("[$category] ${item.description}", fontSize = 11.sp, color = colors.textSecondary, maxLines = 2)
                }
                QLsuSwitch(checked = item.isEnabled, onCheckedChange = { onFunctionToggle(item.id, it) })
            }
        }
    }
}

@Composable
private fun AboutCardLuoSu(
    versionInfo: String,
    onGithubClick: () -> Unit,
    onTelegramClick: () -> Unit,
    onGroupClick: () -> Unit,
    onDonateClick: () -> Unit,
) {
    val colors = QLsuTheme.colors
    Column(
        modifier = Modifier
            .fillMaxWidth()
            .clip(RoundedCornerShape(Dimens.CardCornerRadius))
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadius))
            .padding(16.dp)
    ) {
        Text("关于", fontSize = 13.sp, fontWeight = FontWeight.SemiBold, color = colors.textSecondary)
        Spacer(Modifier.height(6.dp))
        Text(versionInfo.replace("\n", " · "), fontSize = 11.sp, color = colors.textSecondary)
        Spacer(Modifier.height(12.dp))
        Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
            PillButton("GitHub", onGithubClick)
            PillButton("TG", onTelegramClick)
            PillButton("Q群", onGroupClick)
            PillButton("赞助", onDonateClick)
        }
    }
}

@Composable
private fun PillButton(text: String, onClick: () -> Unit) {
    val colors = QLsuTheme.colors
    Box(
        modifier = Modifier
            .clip(RoundedCornerShape(999.dp))
            .glassSurface(RoundedCornerShape(999.dp))
            .pressClick(onClick = onClick)
            .padding(horizontal = 12.dp, vertical = 6.dp)
    ) {
        Text(text, fontSize = 11.sp, color = colors.textPrimary)
    }
}

@Composable
private fun AccountPermissionCard() {
    val colors = QLsuTheme.colors
    val uin = runCatching { luo.qlsu.utils.qq.QQCurrentEnv.currentUin }.getOrDefault("")
    val nick = runCatching { luo.qlsu.utils.qq.QQCurrentEnv.currentNickName }.getOrNull()
    Column(
        modifier = Modifier
            .fillMaxWidth()
            .glassSurface(RoundedCornerShape(Dimens.CardCornerRadiusLarge))
            .padding(16.dp)
    ) {
        Row(verticalAlignment = Alignment.CenterVertically) {
            AccountAvatar(uin, 46)
            Spacer(Modifier.width(12.dp))
            Column(Modifier.weight(1f)) {
                Text(
                    if (uin.isBlank()) "未登录" else (nick?.takeIf { it.isNotBlank() } ?: "QQ $uin"),
                    fontSize = 16.sp,
                    fontWeight = FontWeight.Bold,
                    color = colors.textPrimary
                )
                Text(
                    if (uin.isBlank()) "当前账号信息不可用" else "QQ $uin · 当前登录账号",
                    fontSize = 10.sp,
                    color = colors.textSecondary
                )
            }
            Box(
                modifier = Modifier
                    .clip(RoundedCornerShape(999.dp))
                    .background(colors.accentGreen.copy(alpha = 0.12f))
                    .padding(horizontal = 10.dp, vertical = 4.dp)
            ) { Text("已激活", fontSize = 10.sp, color = colors.accentGreen) }
        }
    }
}