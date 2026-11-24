package luo.qlsu.ui.core.theme

import androidx.compose.animation.animateColorAsState
import androidx.compose.animation.core.tween
import androidx.compose.foundation.isSystemInDarkTheme
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Typography
import androidx.compose.material3.darkColorScheme
import androidx.compose.material3.lightColorScheme
import androidx.compose.runtime.Composable
import androidx.compose.runtime.CompositionLocalProvider
import androidx.compose.runtime.Stable
import androidx.compose.runtime.staticCompositionLocalOf
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.font.Font
import androidx.compose.ui.text.font.FontFamily
import androidx.compose.ui.text.font.FontWeight
import luo.qlsu.R

/**
 * QLsu 的 UI 主题：配色、圆角、字体全部对齐 https://api.luosu.top/
 *  - 主色：340 78% 60%（玫瑰粉）
 *  - 字体：LXGW WenKai Screen（站点 /assets/fonts/lxgwwenkai.woff2 转 TTF 后内置）
 *  - 圆角：12dp / 16dp（对应站点 --radius: .75rem）
 */
private val LuoSuFontFamily = FontFamily(
    Font(R.font.lxgw_wenkai_screen, FontWeight.Normal),
    Font(R.font.lxgw_wenkai_screen, FontWeight.Medium),
    Font(R.font.lxgw_wenkai_screen, FontWeight.SemiBold),
    Font(R.font.lxgw_wenkai_screen, FontWeight.Bold)
)

private fun Typography.withLuoSuFont(): Typography = Typography(
    displayLarge = displayLarge.copy(fontFamily = LuoSuFontFamily),
    displayMedium = displayMedium.copy(fontFamily = LuoSuFontFamily),
    displaySmall = displaySmall.copy(fontFamily = LuoSuFontFamily),
    headlineLarge = headlineLarge.copy(fontFamily = LuoSuFontFamily),
    headlineMedium = headlineMedium.copy(fontFamily = LuoSuFontFamily),
    headlineSmall = headlineSmall.copy(fontFamily = LuoSuFontFamily),
    titleLarge = titleLarge.copy(fontFamily = LuoSuFontFamily),
    titleMedium = titleMedium.copy(fontFamily = LuoSuFontFamily),
    titleSmall = titleSmall.copy(fontFamily = LuoSuFontFamily),
    bodyLarge = bodyLarge.copy(fontFamily = LuoSuFontFamily),
    bodyMedium = bodyMedium.copy(fontFamily = LuoSuFontFamily),
    bodySmall = bodySmall.copy(fontFamily = LuoSuFontFamily),
    labelLarge = labelLarge.copy(fontFamily = LuoSuFontFamily),
    labelMedium = labelMedium.copy(fontFamily = LuoSuFontFamily),
    labelSmall = labelSmall.copy(fontFamily = LuoSuFontFamily)
)

val LuoSuTypography: Typography = Typography().withLuoSuFont()

private val LightColorScheme = lightColorScheme(
    primary = LuoSuPrimary, onPrimary = Color.White,
    secondary = LuoSuPrimary, onSecondary = Color.White,
    background = LightBackground, onBackground = LightTextPrimary,
    surface = LightCardBackground, onSurface = LightTextPrimary,
    surfaceVariant = LightMuted, onSurfaceVariant = LightTextSecondary,
    outline = LightBorder, outlineVariant = LightBorder,
    error = AccentRed, onError = Color.White
)

private val DarkColorScheme = darkColorScheme(
    primary = LuoSuPrimaryDark, onPrimary = Color.White,
    secondary = LuoSuPrimaryDark, onSecondary = Color.White,
    background = DarkBackground, onBackground = DarkTextPrimary,
    surface = DarkCardBackground, onSurface = DarkTextPrimary,
    surfaceVariant = DarkMuted, onSurfaceVariant = DarkTextSecondary,
    outline = DarkBorder, outlineVariant = DarkBorder,
    error = AccentRed, onError = Color.White
)

@Stable
data class QLsuColors(
    val background: Color,
    val cardBackground: Color,
    val textPrimary: Color,
    val textSecondary: Color,
    val ripple: Color,
    val switchTrackOn: Color,
    val switchTrackOff: Color,
    val accentGreen: Color,
    val accentBlue: Color,
    val accentRed: Color,
    val border: Color,
    val isDark: Boolean
)

val LocalQLsuColors = staticCompositionLocalOf {
    QLsuColors(
        LightBackground,
        LightCardBackground,
        LightTextPrimary,
        LightTextSecondary,
        LightRipple,
        SwitchTrackOn,
        SwitchTrackOff,
        AccentGreen,
        AccentBlue,
        AccentRed,
        LightBorder,
        false
    )
}

@Composable
fun QLsuTheme(darkTheme: Boolean = isSystemInDarkTheme(), content: @Composable () -> Unit) {
    val colorScheme = if (darkTheme) DarkColorScheme else LightColorScheme

    @Composable
    fun animateAppColor(target: Color) = animateColorAsState(target, tween(300), label = "").value

    val qlsuColors = QLsuColors(
        background = animateAppColor(if (darkTheme) DarkBackground else LightBackground),
        cardBackground = animateAppColor(if (darkTheme) DarkCardBackground else LightCardBackground),
        textPrimary = animateAppColor(if (darkTheme) DarkTextPrimary else LightTextPrimary),
        textSecondary = animateAppColor(if (darkTheme) DarkTextSecondary else LightTextSecondary),
        ripple = if (darkTheme) DarkRipple else LightRipple,
        switchTrackOn = if (darkTheme) SwitchTrackOnDark else SwitchTrackOn,
        switchTrackOff = if (darkTheme) SwitchTrackOffDark else SwitchTrackOff,
        accentGreen = if (darkTheme) AccentGreenDark else AccentGreen,
        accentBlue = if (darkTheme) LuoSuPrimaryDark else LuoSuPrimary,
        accentRed = AccentRed,
        border = if (darkTheme) DarkBorder else LightBorder,
        isDark = darkTheme
    )

    CompositionLocalProvider(LocalQLsuColors provides qlsuColors) {
        MaterialTheme(
            colorScheme = colorScheme,
            typography = LuoSuTypography,
            content = content
        )
    }
}

object QLsuTheme {
    val colors: QLsuColors @Composable get() = LocalQLsuColors.current
}
