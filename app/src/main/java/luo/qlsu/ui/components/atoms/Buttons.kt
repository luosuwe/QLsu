package luo.qlsu.ui.components.atoms

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.interaction.MutableInteractionSource
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Icon
import androidx.compose.material3.Text
import androidx.compose.material3.ripple
import androidx.compose.runtime.Composable
import androidx.compose.runtime.remember
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.res.painterResource
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import luo.qlsu.ui.core.theme.AccentBlue
import luo.qlsu.ui.core.theme.AccentGreen
import luo.qlsu.ui.core.theme.AccentRed
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.ui.luosu.glassSurface

enum class ActionButtonStyle { Primary, Success, Danger }

@Composable
fun ActionButton(
    text: String,
    onClick: (() -> Unit)?,
    modifier: Modifier = Modifier,
    style: ActionButtonStyle = ActionButtonStyle.Primary
) {
    val colors = QLsuTheme.colors
    val textColor = when (style) {
        ActionButtonStyle.Primary -> colors.textPrimary
        ActionButtonStyle.Success -> colors.textPrimary
        ActionButtonStyle.Danger -> colors.accentRed
    }

    QLsuCard(modifier = modifier, animateContentSize = false, onClick = onClick) {
        Text(
            text = text,
            fontSize = 14.sp,
            fontWeight = FontWeight.Medium,
            color = textColor,
            modifier = Modifier.padding(12.dp, 6.dp)
        )
    }
}

@Composable
fun ConfigButton(
    text: String,
    onClick: () -> Unit,
    modifier: Modifier = Modifier
) {
    val colors = QLsuTheme.colors
    QLsuCard(modifier = modifier, animateContentSize = false, onClick = onClick) {
        Box(
            modifier = Modifier
                .fillMaxWidth()
                .padding(vertical = 14.dp),
            contentAlignment = Alignment.Center
        ) {
            Text(
                text = text,
                fontSize = 14.sp,
                fontWeight = FontWeight.Bold,
                color = colors.textPrimary,
                textAlign = TextAlign.Center
            )
        }
    }
}

@Composable
fun SocialButton(
    iconRes: Int,
    label: String,
    onClick: () -> Unit,
    modifier: Modifier = Modifier
) {
    val colors = QLsuTheme.colors
    Column(modifier = modifier, horizontalAlignment = Alignment.CenterHorizontally) {
        QLsuCard(modifier = Modifier.size(48.dp), animateContentSize = false, onClick = onClick) {
            Box(
                modifier = Modifier
                    .size(48.dp)
                    .padding(10.dp),
                contentAlignment = Alignment.Center
            ) {
                Icon(
                    painter = painterResource(iconRes),
                    contentDescription = label,
                    modifier = Modifier.size(28.dp),
                    tint = colors.textPrimary
                )
            }
        }
        Spacer(modifier = Modifier.height(8.dp))
        Text(
            text = label,
            fontSize = 12.sp,
            fontWeight = FontWeight.Bold,
            color = colors.textSecondary
        )
    }
}

@Composable
fun DialogButton(
    text: String,
    onClick: () -> Unit,
    isPrimary: Boolean,
    modifier: Modifier = Modifier
) {
    val colors = QLsuTheme.colors
    val textColor = if (isPrimary) Color.White else colors.textPrimary

    Box(
        modifier = modifier
            .clip(RoundedCornerShape(16.dp))
            .then(
                if (isPrimary) Modifier.background(AccentBlue)
                else Modifier.background(if (colors.isDark) androidx.compose.ui.graphics.Color(0xFF2A2A2E) else androidx.compose.ui.graphics.Color(0xFFF2F2F6))
            )
            .clickable(
                interactionSource = remember { MutableInteractionSource() },
                indication = ripple(color = colors.ripple),
                onClick = onClick
            )
            .padding(24.dp, 14.dp),
        contentAlignment = Alignment.Center
    ) {
        Text(text = text, fontSize = 15.sp, fontWeight = FontWeight.Medium, color = textColor)
    }
}

