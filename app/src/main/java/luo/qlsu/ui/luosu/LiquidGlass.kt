package luo.qlsu.ui.luosu

import android.graphics.Bitmap
import android.graphics.Canvas
import android.graphics.Paint
import android.graphics.RectF
import android.os.Build
import androidx.compose.foundation.background
import androidx.compose.foundation.border
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.composed
import androidx.compose.ui.draw.drawBehind
import androidx.compose.ui.draw.shadow
import androidx.compose.ui.geometry.Offset
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.Path
import androidx.compose.ui.graphics.Shape
import androidx.compose.ui.graphics.addOutline
import androidx.compose.ui.graphics.asAndroidPath
import androidx.compose.ui.graphics.drawscope.Stroke
import androidx.compose.ui.graphics.drawscope.drawIntoCanvas
import androidx.compose.ui.graphics.nativeCanvas
import androidx.compose.ui.layout.onGloballyPositioned
import androidx.compose.ui.layout.positionInRoot
import androidx.compose.ui.unit.Dp
import androidx.compose.ui.unit.dp
import luo.qlsu.ui.Wallpaper
import luo.qlsu.ui.core.theme.QLsuTheme
import kotlin.math.max

/**
 * 液态玻璃：卡片本身透明，用壁纸的模糊副本按卡片位置裁切，
 * 再叠白色描边 + 顶部内高光 + 底部内发光 + 外阴影，对齐后台的 liquid glass。
 */
fun Modifier.liquidGlass(
    shape: Shape = RoundedCornerShape(14.dp),
    blurPx: Float = 8f,
): Modifier = composed {
    var posInRoot by remember { mutableStateOf(Offset.Zero) }
    val darkTheme = QLsuTheme.colors.isDark
    val frost = Wallpaper.frost
    val sharp = Wallpaper.sharp
    val screenW = Wallpaper.layerWidth
    val screenH = Wallpaper.layerHeight

    this
        .onGloballyPositioned { coords -> posInRoot = coords.positionInRoot() }
        .shadow(
            elevation = 10.dp,
            shape = shape,
            ambientColor = Color(0x1F0F172A),
            spotColor = Color(0x1F0F172A)
        )
        .drawBehind {
            val bmp = frost ?: sharp
            if (bmp == null || screenW <= 0 || screenH <= 0) {
                // QQ 进程里读不到模块 App 的壁纸：退化成高白度玻璃，保证卡片可见
                val outline0 = shape.createOutline(size, layoutDirection, this)
                val path0 = Path().apply { addOutline(outline0) }
                drawPath(
                    path0,
                    color = if (darkTheme) Color(0xE61A1719) else Color(0xE6FFFFFF)
                )
                drawPath(path0, color = Color.White.copy(alpha = if (darkTheme) 0.10f else 0.55f), style = Stroke(1.dp.toPx()))
                return@drawBehind
            }

            val outline = shape.createOutline(size, layoutDirection, this)
            val path = Path().apply { addOutline(outline) }

            drawIntoCanvas { canvas ->
                val native = canvas.nativeCanvas
                val paint = Paint(Paint.FILTER_BITMAP_FLAG)
                native.save()
                native.clipPath(path.asAndroidPath())
                native.translate(-posInRoot.x, -posInRoot.y)
                val scale = max(screenW.toFloat() / bmp.width, screenH.toFloat() / bmp.height)
                val dw = bmp.width * scale
                val dh = bmp.height * scale
                val left = (screenW - dw) / 2f
                val top = (screenH - dh) / 2f
                native.drawBitmap(bmp, null, RectF(left, top, left + dw, top + dh), paint)
                native.restore()
            }

            // 白色玻璃层：参考站卡片其实是「磨砂 + 高白度渐变」，不是直接透壁纸
            val dark = darkTheme
            if (dark) {
                drawRect(brush = Brush.verticalGradient(listOf(Color(0xF01A1719), Color(0xE01A1719))))
            } else {
                drawRect(
                    brush = Brush.verticalGradient(
                        listOf(Color.White.copy(alpha = 0.80f), Color.White.copy(alpha = 0.66f))
                    )
                )
                drawRect(
                    brush = Brush.linearGradient(
                        listOf(Color(0x33FFD9E6), Color(0x11FFE9F2), Color.Transparent),
                        start = Offset.Zero,
                        end = Offset(size.width, size.height)
                    )
                )
            }
            // 描边 72% 白
            drawPath(path, color = Color.White.copy(alpha = 0.72f), style = Stroke(width = 1.dp.toPx()))
            // 顶部内高光
            drawLine(
                brush = Brush.horizontalGradient(
                    listOf(Color.White.copy(alpha = 0.0f), Color.White.copy(alpha = 0.95f), Color.White.copy(alpha = 0.0f))
                ),
                start = Offset(10.dp.toPx(), 1.dp.toPx()),
                end = Offset(size.width - 10.dp.toPx(), 1.dp.toPx()),
                strokeWidth = 1.dp.toPx()
            )
            // 底部内发光
            drawRect(
                brush = Brush.verticalGradient(
                    listOf(Color.Transparent, Color.White.copy(alpha = 0.16f)),
                    startY = size.height * 0.55f,
                    endY = size.height
                )
            )
        }
}

/** 兼容旧调用：现在等价于液态玻璃 */
fun Modifier.glassSurface(
    shape: Shape = RoundedCornerShape(14.dp),
    tintAlpha: Float = 0.0f,
    blurRadius: Dp = 8.dp,
): Modifier = liquidGlass(shape, blurRadius.value)
