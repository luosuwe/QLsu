package luo.qlsu.ui.luosu

import androidx.compose.animation.core.animateFloatAsState
import androidx.compose.animation.core.spring
import androidx.compose.foundation.interaction.MutableInteractionSource
import androidx.compose.foundation.interaction.collectIsPressedAsState
import androidx.compose.material3.ripple
import androidx.compose.runtime.getValue
import androidx.compose.runtime.remember
import androidx.compose.ui.graphics.graphicsLayer
import androidx.compose.foundation.Canvas
import androidx.compose.foundation.background
import androidx.compose.foundation.border
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.draw.shadow
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.Path
import androidx.compose.ui.graphics.Shape
import androidx.compose.ui.graphics.StrokeCap
import androidx.compose.ui.graphics.StrokeJoin
import androidx.compose.ui.graphics.drawscope.Stroke
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.Dp
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import luo.qlsu.ui.core.theme.QLsuTheme

/**
 * 毛玻璃（frosted glass）风格：
 * 浅色纯白背景 + 白色半透明卡片 + 细边 + 投影；暗色近黑背景 + 深灰卡片。
 * 不使用液态玻璃的折射/模糊着色器。
 */
@Composable
fun LuoSuGlassRoot(modifier: Modifier = Modifier, content: @Composable () -> Unit) {
    val dark = QLsuTheme.colors.isDark
    Box(
        modifier = modifier
            .fillMaxSize()
            .background(if (dark) Color(0xFF0B090A) else Color(0xFFF5F5F7))
    ) {
        content()
    }
}

@Composable
fun Modifier.glassSurface(
    shape: Shape = RoundedCornerShape(14.dp),
    blurRadius: Dp = 24.dp,
    tintAlpha: Float = 0.72f,
): Modifier {
    val dark = QLsuTheme.colors.isDark
    // 液态玻璃：低不透明度填充 + 白色描边 + 左上高光
    val fill = if (dark) Color(0xFF161617).copy(alpha = 0.55f) else Color.White.copy(alpha = 0.26f)
    val stroke = if (dark) Color.White.copy(alpha = 0.12f) else Color.White.copy(alpha = 0.55f)
    val highlight = Brush.linearGradient(
        colors = listOf(
            Color.White.copy(alpha = if (dark) 0.10f else 0.30f),
            Color.White.copy(alpha = 0.02f),
            Color.Transparent
        )
    )
    return this
        .shadow(
            elevation = if (dark) 0.dp else 6.dp,
            shape = shape,
            ambientColor = Color.Black.copy(alpha = 0.05f),
            spotColor = Color.Black.copy(alpha = 0.07f)
        )
        .background(fill, shape)
        .background(highlight, shape)
        .border(1.dp, stroke, shape)
}

/** 玻璃圆形返回键（不是文字按钮） */
@Composable
fun GlassBackButton(onClick: () -> Unit, modifier: Modifier = Modifier) {
    val colors = QLsuTheme.colors
    Box(
        modifier = modifier
            .size(36.dp)
            .glassSurface(CircleShape, tintAlpha = 0.9f)
            .clip(CircleShape)
            .pressClick(onClick = onClick),
        contentAlignment = Alignment.Center
    ) {
        Canvas(Modifier.size(15.dp)) {
            val p = Path().apply {
                moveTo(size.width * 0.66f, size.height * 0.12f)
                lineTo(size.width * 0.30f, size.height * 0.5f)
                lineTo(size.width * 0.66f, size.height * 0.88f)
            }
            drawPath(
                path = p,
                color = colors.textPrimary,
                style = Stroke(width = 2.dp.toPx(), cap = StrokeCap.Round, join = StrokeJoin.Round)
            )
        }
    }
}

/** 白色/深色胶囊标签栏（脚本页 本地/在线 切换） */
@Composable
fun GlassTabBar(
    options: List<String>,
    selectedIndex: Int,
    onSelect: (Int) -> Unit,
    modifier: Modifier = Modifier,
) {
    val colors = QLsuTheme.colors
    Row(
        modifier = modifier
            .glassSurface(RoundedCornerShape(999.dp), tintAlpha = 0.9f)
            .padding(4.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        options.forEachIndexed { index, label ->
            val selected = index == selectedIndex
            Box(
                modifier = Modifier
                    .clip(RoundedCornerShape(999.dp))
                    .background(
                        if (selected) {
                            if (colors.isDark) Color(0xFF2C2C2E) else Color(0xFF111114)
                        } else Color.Transparent
                    )
                    .pressClick { onSelect(index) }
                    .padding(horizontal = 18.dp, vertical = 8.dp),
                contentAlignment = Alignment.Center
            ) {
                Text(
                    text = label,
                    fontSize = 12.sp,
                    fontWeight = if (selected) FontWeight.SemiBold else FontWeight.Normal,
                    color = if (selected) Color.White else colors.textSecondary
                )
            }
        }
    }
}

/** 圆形图标按钮（搜索/主题） */
@Composable
fun GlassIconButton(
    painter: androidx.compose.ui.graphics.painter.Painter,
    onClick: () -> Unit,
    modifier: Modifier = Modifier,
) {
    val colors = QLsuTheme.colors
    Box(
        modifier = modifier
            .size(38.dp)
            .glassSurface(CircleShape, tintAlpha = 0.9f)
            .clip(CircleShape)
            .pressClick(onClick = onClick),
        contentAlignment = Alignment.Center
    ) {
        androidx.compose.material3.Icon(
            painter = painter,
            contentDescription = null,
            tint = colors.textPrimary,
            modifier = Modifier.size(18.dp)
        )
    }
}
/** 点击按压缩放 + 涟漪，给所有玻璃组件统一交互反馈 */
@Composable
fun Modifier.pressClick(enabled: Boolean = true, onClick: () -> Unit): Modifier {
    val interaction = remember { MutableInteractionSource() }
    val pressed by interaction.collectIsPressedAsState()
    val scale by animateFloatAsState(
        targetValue = if (pressed) 0.955f else 1f,
        animationSpec = spring(stiffness = 700f, dampingRatio = 0.7f),
        label = "pressScale"
    )
    return this
        .graphicsLayer {
            scaleX = scale
            scaleY = scale
        }
        .clickable(
            interactionSource = interaction,
            indication = ripple(color = Color(0x33000000)),
            enabled = enabled,
            onClick = onClick
        )
}