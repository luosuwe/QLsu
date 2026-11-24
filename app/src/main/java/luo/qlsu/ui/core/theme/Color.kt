package luo.qlsu.ui.core.theme

import androidx.compose.ui.graphics.Color

/**
 * 配色取自 https://api.luosu.top/ 的 CSS 变量（HSL → RGB）：
 *  --primary: 340 78% 60%（浅色） / 340 78% 65%（深色）
 *  --background/--card: 0 0% 100% / 340 10% 3.9%
 *  --muted-foreground: 340 3.8% 46.1%
 *  --border: 340 5.9% 90%
 */
val LightBackground = Color(0xFFFFFFFF)
val LightCardBackground = Color(0xFFFFFFFF)
val LightTextPrimary = Color(0xFF0B090A)
val LightTextSecondary = Color(0xFF7A7174)
val LightRipple = Color(0x14E9497E)
val LightBorder = Color(0xFFE7E4E5)
val LightMuted = Color(0xFFF5F4F4)

val DarkBackground = Color(0xFF0B090A)
val DarkCardBackground = Color(0xFF141012)
val DarkTextPrimary = Color(0xFFFAFAFA)
val DarkTextSecondary = Color(0xFFAAA1A4)
val DarkRipple = Color(0x24EB608F)
val DarkBorder = Color(0xFF2A2728)
val DarkMuted = Color(0xFF1B1719)

/** 洛苏主色（玫瑰粉） */
val LuoSuPrimary = Color(0xFFE9497E)
val LuoSuPrimaryDark = Color(0xFFEB608F)

val AccentGreen = Color(0xFF22C55E)
val AccentGreenDark = Color(0xFF34D399)
val AccentBlue = LuoSuPrimary
val AccentRed = Color(0xFFEF4444)
val AccentOrange = Color(0xFFF59E0B)

val SwitchThumbOff = Color(0xFFFFFFFF)
val SwitchThumbOn = Color(0xFFFFFFFF)
val SwitchTrackOff = Color(0xFFE7E4E5)
val SwitchTrackOffDark = Color(0xFF2A2728)
val SwitchTrackOn = LuoSuPrimary
val SwitchTrackOnDark = LuoSuPrimaryDark
