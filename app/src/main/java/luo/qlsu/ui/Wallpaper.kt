package luo.qlsu.ui

import android.content.Context
import android.graphics.BitmapFactory
import androidx.activity.compose.rememberLauncherForActivityResult
import androidx.activity.result.contract.ActivityResultContracts
import androidx.compose.foundation.Image
import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.AlertDialog
import androidx.compose.material3.OutlinedTextField
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.blur
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.ImageBitmap
import androidx.compose.ui.graphics.asImageBitmap
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.layout.onSizeChanged
import androidx.compose.ui.platform.LocalContext
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import luo.qlsu.ui.luosu.glassSurface
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import java.io.File
import java.io.FileOutputStream
import java.net.HttpURLConnection
import java.net.URL

/**
 * 全局壁纸：默认 https://t.alcy.cc/ycy，也可自定义链接或本地图片。
 * 本地图片复制到 App 私有目录后直接使用。
 */
object Wallpaper {

    var sharp by androidx.compose.runtime.mutableStateOf<android.graphics.Bitmap?>(null)
        private set
    var frost by androidx.compose.runtime.mutableStateOf<android.graphics.Bitmap?>(null)
        private set
    var layerWidth by androidx.compose.runtime.mutableIntStateOf(0)
        private set
    var layerHeight by androidx.compose.runtime.mutableIntStateOf(0)
        private set

    fun setLayerSize(w: Int, h: Int) {
        if (w != layerWidth || h != layerHeight) {
            layerWidth = w
            layerHeight = h
        }
    }


    var revision by androidx.compose.runtime.mutableIntStateOf(0)

    private const val PREFS = "qlsu_wallpaper"
    private const val KEY_URL = "url"
    private const val KEY_LOCAL = "local"
    private const val DEFAULT_URL = "https://t.alcy.cc/ycy"

    fun url(ctx: Context): String =
        ctx.getSharedPreferences(PREFS, Context.MODE_PRIVATE).getString(KEY_URL, "") ?: ""

    fun local(ctx: Context): String =
        ctx.getSharedPreferences(PREFS, Context.MODE_PRIVATE).getString(KEY_LOCAL, "") ?: ""

    fun setUrl(ctx: Context, url: String) {
        revision++
        ctx.getSharedPreferences(PREFS, Context.MODE_PRIVATE).edit()
            .putString(KEY_URL, url.trim()).remove(KEY_LOCAL).apply()
    }

    fun setLocal(ctx: Context, path: String) {
        revision++
        ctx.getSharedPreferences(PREFS, Context.MODE_PRIVATE).edit()
            .putString(KEY_LOCAL, path).remove(KEY_URL).apply()
    }

    fun clear(ctx: Context) {
        revision++
        ctx.getSharedPreferences(PREFS, Context.MODE_PRIVATE).edit().clear().apply()
    }

    fun source(ctx: Context): String {
        val local = local(ctx)
        if (local.isNotBlank() && File(local).isFile) return local
        return url(ctx).ifBlank { DEFAULT_URL }
    }

    private suspend fun load(ctx: Context): ImageBitmap? = withContext(Dispatchers.IO) {
        runCatching {
            val src = source(ctx)
            val bytes = if (src.startsWith("/")) {
                File(src).readBytes()
            } else {
                val conn = (URL(src).openConnection() as HttpURLConnection).apply {
                    connectTimeout = 10000
                    readTimeout = 15000
                    instanceFollowRedirects = true
                    setRequestProperty(
                        "User-Agent",
                        "Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 Chrome/120 Mobile Safari/537.36"
                    )
                }
                conn.inputStream.use { it.readBytes() }
            }
            val bmp = BitmapFactory.decodeByteArray(bytes, 0, bytes.size)
            if (bmp != null) {
                sharp = bmp
                frost = makeFrost(bmp, 8f)
            }
            bmp?.asImageBitmap()
        }.getOrNull()
    }

    private fun makeFrost(src: android.graphics.Bitmap, radius: Float): android.graphics.Bitmap {
        // 真高斯近似：先缩小到 480 宽，做三次盒式模糊（等价高斯），再平滑放大
        val targetW = 480
        val scale = targetW.toFloat() / src.width
        val smallW = targetW.coerceAtMost(src.width)
        val smallH = (src.height * scale).toInt().coerceAtLeast(1)
        val small = android.graphics.Bitmap.createScaledBitmap(src, smallW, smallH, true)

        val w = small.width
        val h = small.height
        val pix = IntArray(w * h)
        small.getPixels(pix, 0, w, 0, 0, w, h)
        val r = (radius / 2.2f).toInt().coerceIn(4, 32)
        boxBlur(pix, w, h, r)
        boxBlur(pix, w, h, r)
        boxBlur(pix, w, h, r)
        val blurred = android.graphics.Bitmap.createBitmap(w, h, android.graphics.Bitmap.Config.ARGB_8888)
        blurred.setPixels(pix, 0, w, 0, 0, w, h)

        // 放大回原尺寸，双线性插值让边缘平滑（不是马赛克）
        return android.graphics.Bitmap.createScaledBitmap(blurred, src.width, src.height, true)
    }

    /** 盒式模糊（对 ARGB 逐通道），三次叠加近似高斯 */
    private fun boxBlur(pix: IntArray, w: Int, h: Int, radius: Int) {
        val r = radius.coerceAtLeast(1)
        val div = r * 2 + 1
        val tmp = IntArray(pix.size)

        // 横向
        for (y in 0 until h) {
            var a = 0; var rr = 0; var g = 0; var b = 0
            val row = y * w
            for (x in -r until w) {
                val add = if (x + r < w) pix[row + (x + r).coerceAtLeast(0)] else 0
                val sub = if (x - r - 1 >= 0) pix[row + (x - r - 1)] else 0
                a += (add ushr 24) - (sub ushr 24)
                rr += ((add shr 16) and 0xFF) - ((sub shr 16) and 0xFF)
                g += ((add shr 8) and 0xFF) - ((sub shr 8) and 0xFF)
                b += (add and 0xFF) - (sub and 0xFF)
                if (x >= 0) {
                    tmp[row + x] = ((a / div) shl 24) or ((rr / div) shl 16) or ((g / div) shl 8) or (b / div)
                }
            }
        }

        // 纵向
        for (x in 0 until w) {
            var a = 0; var rr = 0; var g = 0; var b = 0
            for (y in -r until h) {
                val add = if (y + r < h) tmp[(y + r).coerceAtLeast(0) * w + x] else 0
                val sub = if (y - r - 1 >= 0) tmp[(y - r - 1) * w + x] else 0
                a += (add ushr 24) - (sub ushr 24)
                rr += ((add shr 16) and 0xFF) - ((sub shr 16) and 0xFF)
                g += ((add shr 8) and 0xFF) - ((sub shr 8) and 0xFF)
                b += (add and 0xFF) - (sub and 0xFF)
                if (y >= 0) {
                    pix[y * w + x] = ((a / div) shl 24) or ((rr / div) shl 16) or ((g / div) shl 8) or (b / div)
                }
            }
        }
    }

    fun copyToLocal(ctx: Context, file: File): String? = runCatching {
        val dir = File(ctx.filesDir, "wallpaper").apply { mkdirs() }
        val target = File(dir, "bg_${System.currentTimeMillis()}.jpg")
        file.inputStream().use { input -> FileOutputStream(target).use { input.copyTo(it) } }
        target.absolutePath
    }.getOrNull()

    @Composable
    fun WallpaperLayer() {
        val ctx = LocalContext.current
        val key = "${revision}-${url(ctx)}-${local(ctx)}"
        var bmp by remember(key) { mutableStateOf<ImageBitmap?>(null) }
        LaunchedEffect(key) { bmp = load(ctx) }
        bmp?.let {
            Image(
                bitmap = it,
                contentDescription = null,
                modifier = Modifier.fillMaxSize().onSizeChanged { setLayerSize(it.width, it.height) },
                contentScale = ContentScale.Crop
            )
            Box(Modifier.fillMaxSize().background(Color.White.copy(alpha = 0.42f)))
        }
    }

    @Composable
    fun Background(content: @Composable () -> Unit) {
        val ctx = LocalContext.current
        val key = "${revision}-${url(ctx)}-${local(ctx)}"
        var bmp by remember(key) { mutableStateOf<ImageBitmap?>(null) }
        LaunchedEffect(key) { bmp = load(ctx) }

        Box(Modifier.fillMaxSize().background(Color(0xFFF4F6F9))) {
            bmp?.let {
                Image(
                    bitmap = it,
                    contentDescription = null,
                    modifier = Modifier.fillMaxSize(),
                    contentScale = ContentScale.Crop
                )
                Box(Modifier.fillMaxSize().background(Color.White.copy(alpha = 0.42f)))
            }
            content()
        }
    }
}

@Composable
fun WallpaperButton(modifier: Modifier = Modifier) {
    val ctx = LocalContext.current
    var show by remember { mutableStateOf(false) }

    val picker = rememberLauncherForActivityResult(ActivityResultContracts.GetContent()) { uri ->
        if (uri != null) {
            val tmp = File(ctx.cacheDir, "picked_wallpaper")
            runCatching {
                ctx.contentResolver.openInputStream(uri)?.use { input ->
                    FileOutputStream(tmp).use { input.copyTo(it) }
                }
            }
            Wallpaper.copyToLocal(ctx, tmp)?.let { Wallpaper.setLocal(ctx, it) }
            show = false
        }
    }

    androidx.compose.foundation.Image(
        painter = androidx.compose.ui.res.painterResource(luo.qlsu.R.drawable.ic_wallpaper),
        contentDescription = "自定义背景",
        modifier = modifier
            .size(36.dp)
            .glassSurface(androidx.compose.foundation.shape.CircleShape, tintAlpha = 0.9f)
            .clip(androidx.compose.foundation.shape.CircleShape)
            .clickable { show = true }
            .padding(8.dp)
    )

    if (show) {
        var urlText by remember { mutableStateOf(Wallpaper.url(ctx)) }
        AlertDialog(
            onDismissRequest = { show = false },
            title = { Text("自定义背景") },
            text = {
                Column {
                    OutlinedTextField(
                        value = urlText,
                        onValueChange = { urlText = it },
                        label = { Text("图片链接") },
                        singleLine = true,
                        modifier = Modifier.fillMaxWidth().padding(bottom = 8.dp)
                    )
                    TextButton(onClick = {
                        if (urlText.isNotBlank()) Wallpaper.setUrl(ctx, urlText)
                        show = false
                    }) { Text("使用链接") }
                    TextButton(onClick = { picker.launch("image/*") }) { Text("从本地选择图片") }
                    TextButton(onClick = {
                        Wallpaper.clear(ctx)
                        show = false
                    }) { Text("恢复默认") }
                }
            },
            confirmButton = { TextButton(onClick = { show = false }) { Text("关闭") } }
        )
    }
}
