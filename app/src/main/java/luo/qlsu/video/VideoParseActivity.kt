package luo.qlsu.video

import android.app.Activity
import android.content.ContentValues
import android.content.Intent
import android.graphics.BitmapFactory
import android.graphics.Color
import android.net.Uri
import android.os.Build
import android.os.Bundle
import android.os.Environment
import android.provider.MediaStore
import android.text.InputType
import android.view.Gravity
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.HorizontalScrollView
import android.widget.ImageView
import android.widget.LinearLayout
import android.widget.ScrollView
import android.widget.TextView
import android.widget.Toast
import java.io.File
import java.io.FileOutputStream
import java.net.HttpURLConnection
import java.net.URL

/**
 * 视频 / 图文解析页：
 * - 视频：播放或保存到 Movies/QLsu
 * - 图文：显示图片，长按进入多选，勾选后保存到 Pictures/QLsu
 * 也注册了 ACTION_SEND，可从别的 App 分享进来。
 */
class VideoParseActivity : Activity() {

    private lateinit var input: EditText
    private lateinit var status: TextView
    private lateinit var playBtn: Button
    private lateinit var saveBtn: Button
    private lateinit var imageRow: LinearLayout
    private lateinit var imageScroll: HorizontalScrollView
    private lateinit var saveImagesBtn: Button

    private var result: VideoParser.VideoInfo? = null
    private val selected = linkedSetOf<String>()
    private var selecting = false

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        val root = LinearLayout(this).apply {
            orientation = LinearLayout.VERTICAL
            setPadding(48, 48, 48, 48)
            setBackgroundColor(Color.parseColor("#F6F7F9"))
        }

        val title = TextView(this).apply {
            text = "视频解析"
            textSize = 22f
            setTextColor(Color.parseColor("#1A1A1A"))
            setPadding(0, 0, 0, 8)
        }
        val hint = TextView(this).apply {
            text = "支持抖音、快手、哔哩哔哩。视频可直接播放/保存；图文长按图片多选后保存。"
            textSize = 13f
            setTextColor(Color.parseColor("#6B7280"))
            setPadding(0, 0, 0, 24)
        }

        input = EditText(this).apply {
            this.hint = "粘贴视频分享链接"
            inputType = InputType.TYPE_CLASS_TEXT or InputType.TYPE_TEXT_FLAG_MULTI_LINE
            minLines = 2
            setTextColor(Color.parseColor("#1A1A1A"))
        }

        val parseBtn = Button(this).apply {
            text = "解析最高画质"
            setOnClickListener { parse() }
        }

        status = TextView(this).apply {
            textSize = 13f
            setTextColor(Color.parseColor("#6B7280"))
            setPadding(0, 16, 0, 8)
        }

        imageRow = LinearLayout(this).apply {
            orientation = LinearLayout.HORIZONTAL
            setPadding(0, 8, 0, 8)
        }
        imageScroll = HorizontalScrollView(this).apply {
            visibility = View.GONE
            addView(imageRow)
        }

        playBtn = Button(this).apply {
            text = "播放"
            visibility = View.GONE
            setOnClickListener { play() }
        }
        saveBtn = Button(this).apply {
            text = "保存视频"
            visibility = View.GONE
            setOnClickListener { save() }
        }
        saveImagesBtn = Button(this).apply {
            text = "保存选中图片"
            visibility = View.GONE
            setOnClickListener { saveSelectedImages() }
        }

        val videoActions = LinearLayout(this).apply {
            orientation = LinearLayout.HORIZONTAL
            addView(playBtn, LinearLayout.LayoutParams(0, LinearLayout.LayoutParams.WRAP_CONTENT, 1f))
            addView(saveBtn, LinearLayout.LayoutParams(0, LinearLayout.LayoutParams.WRAP_CONTENT, 1f))
        }

        root.addView(title)
        root.addView(hint)
        root.addView(input, LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT))
        root.addView(parseBtn, LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT))
        root.addView(status)
        root.addView(imageScroll, LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT, 320))
        root.addView(videoActions)
        root.addView(saveImagesBtn)
        setContentView(ScrollView(this).apply { addView(root) })

        if (intent?.action == Intent.ACTION_SEND && intent.type?.startsWith("text/") == true) {
            val shared = intent.getStringExtra(Intent.EXTRA_TEXT).orEmpty()
            if (shared.isNotBlank()) {
                input.setText(shared)
                parse()
            }
        }
    }

    private fun parse() {
        val text = input.text?.toString().orEmpty().trim()
        if (text.isEmpty()) {
            toast("先粘贴视频链接")
            return
        }
        status.text = "正在解析…"
        playBtn.visibility = View.GONE
        saveBtn.visibility = View.GONE
        saveImagesBtn.visibility = View.GONE
        imageScroll.visibility = View.GONE
        imageRow.removeAllViews()
        selected.clear()
        selecting = false

        Thread {
            val info = VideoParser.parse(text)
            runOnUiThread {
                if (info == null) {
                    result = null
                    status.text = "解析失败：链接无效或平台暂不支持"
                    return@runOnUiThread
                }
                result = info
                val parts = mutableListOf(info.platform, info.title)
                if (info.url.isNotBlank()) parts.add("视频")
                if (info.images.isNotEmpty()) parts.add("${info.images.size} 张图片")
                status.text = parts.joinToString(" · ")
                if (info.url.isNotBlank()) {
                    playBtn.visibility = View.VISIBLE
                    saveBtn.visibility = View.VISIBLE
                }
                if (info.images.isNotEmpty()) {
                    showImages(info.images)
                }
            }
        }.start()
    }

    private fun showImages(urls: List<String>) {
        imageScroll.visibility = View.VISIBLE
        saveImagesBtn.visibility = View.VISIBLE
        updateSaveImagesText()
        urls.forEach { url ->
            val iv = ImageView(this).apply {
                layoutParams = LinearLayout.LayoutParams(300, 300).apply { setMargins(0, 0, 12, 0) }
                scaleType = ImageView.ScaleType.CENTER_CROP
                setBackgroundColor(Color.parseColor("#E5E7EB"))
                setOnLongClickListener {
                    if (!selecting) {
                        selecting = true
                        selected.add(url)
                    } else if (selected.contains(url)) {
                        selected.remove(url)
                    } else {
                        selected.add(url)
                    }
                    refreshImageSelection()
                    updateSaveImagesText()
                    true
                }
                setOnClickListener {
                    if (!selecting) return@setOnClickListener
                    if (selected.contains(url)) selected.remove(url) else selected.add(url)
                    refreshImageSelection()
                    updateSaveImagesText()
                }
                tag = url
            }
            imageRow.addView(iv)
            Thread {
                val bmp = loadBitmap(url)
                if (bmp != null) runOnUiThread { iv.setImageBitmap(bmp) }
            }.start()
        }
    }

    private fun refreshImageSelection() {
        for (i in 0 until imageRow.childCount) {
            val v = imageRow.getChildAt(i)
            val url = v.tag as? String ?: continue
            v.alpha = if (!selecting || selected.contains(url)) 1f else 0.4f
            v.setBackgroundColor(
                if (selected.contains(url)) Color.parseColor("#E9497E") else Color.parseColor("#E5E7EB")
            )
        }
    }

    private fun updateSaveImagesText() {
        saveImagesBtn.text = if (selected.isEmpty()) "长按图片选择" else "保存选中图片 (${selected.size})"
    }

    private fun loadBitmap(url: String) = runCatching {
        val conn = (URL(url).openConnection() as HttpURLConnection).apply {
            connectTimeout = 10000
            readTimeout = 15000
            setRequestProperty("User-Agent", "Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 Chrome/120 Mobile Safari/537.36")
        }
        conn.inputStream.use { BitmapFactory.decodeStream(it) }
    }.getOrNull()

    private fun saveSelectedImages() {
        if (selected.isEmpty()) {
            toast("长按图片勾选后再保存")
            return
        }
        status.text = "正在保存图片…"
        val list = selected.toList()
        Thread {
            var ok = 0
            list.forEachIndexed { index, url ->
                if (saveImageToPictures(url, index)) ok++
            }
            runOnUiThread {
                status.text = "已保存 $ok/${list.size} 张到 Pictures/QLsu"
                toast(if (ok > 0) "图片已保存到本地" else "保存失败")
            }
        }.start()
    }

    private fun saveImageToPictures(url: String, index: Int): Boolean = runCatching {
        val conn = (URL(url).openConnection() as HttpURLConnection).apply {
            connectTimeout = 10000
            readTimeout = 20000
        }
        val bytes = conn.inputStream.use { it.readBytes() }
        val name = "QLsu_${System.currentTimeMillis()}_$index.jpg"

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.Q) {
            val values = ContentValues().apply {
                put(MediaStore.Images.Media.DISPLAY_NAME, name)
                put(MediaStore.Images.Media.MIME_TYPE, "image/jpeg")
                put(MediaStore.Images.Media.RELATIVE_PATH, Environment.DIRECTORY_PICTURES + "/QLsu")
                put(MediaStore.Images.Media.IS_PENDING, 1)
            }
            val uri = contentResolver.insert(MediaStore.Images.Media.EXTERNAL_CONTENT_URI, values) ?: return false
            contentResolver.openOutputStream(uri)?.use { it.write(bytes) } ?: return false
            values.clear()
            values.put(MediaStore.Images.Media.IS_PENDING, 0)
            contentResolver.update(uri, values, null, null)
            true
        } else {
            val dir = File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES), "QLsu")
            if (!dir.exists()) dir.mkdirs()
            FileOutputStream(File(dir, name)).use { it.write(bytes) }
            true
        }
    }.getOrDefault(false)

    private fun play() {
        val info = result ?: return
        if (info.url.isBlank()) return
        runCatching {
            startActivity(Intent(Intent.ACTION_VIEW).apply {
                setDataAndType(Uri.parse(info.url), "video/*")
                addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
            })
        }.onFailure { toast("没有可用的播放器，请先保存到本地") }
    }

    private fun save() {
        val info = result ?: return
        if (info.url.isBlank()) return
        status.text = "正在下载…"
        Thread {
            val ok = runCatching { saveToMovies(info) }.getOrDefault(false)
            runOnUiThread {
                status.text = if (ok) "已保存到 Movies/QLsu：${info.title}" else "保存失败，请换网络重试"
                toast(if (ok) "已保存到本地视频目录" else "保存失败")
            }
        }.start()
    }

    private fun saveToMovies(info: VideoParser.VideoInfo): Boolean {
        val safe = info.title.replace(Regex("[\\\\/:*?\"<>|]"), "_").take(60).ifBlank { "video" }
        val name = "$safe.mp4"

        val headers = when (info.platform) {
            "哔哩哔哩" -> mapOf(
                "Referer" to "https://www.bilibili.com/",
                "User-Agent" to "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 " +
                    "(KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
            )
            else -> mapOf(
                "User-Agent" to "Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 " +
                    "(KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36"
            )
        }

        val conn = (URL(info.url).openConnection() as HttpURLConnection).apply {
            connectTimeout = 15000
            readTimeout = 30000
            headers.forEach { (k, v) -> setRequestProperty(k, v) }
        }

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.Q) {
            val values = ContentValues().apply {
                put(MediaStore.Video.Media.DISPLAY_NAME, name)
                put(MediaStore.Video.Media.MIME_TYPE, "video/mp4")
                put(MediaStore.Video.Media.RELATIVE_PATH, Environment.DIRECTORY_MOVIES + "/QLsu")
                put(MediaStore.Video.Media.IS_PENDING, 1)
            }
            val uri = contentResolver.insert(MediaStore.Video.Media.EXTERNAL_CONTENT_URI, values) ?: return false
            contentResolver.openOutputStream(uri)?.use { out ->
                conn.inputStream.use { it.copyTo(out, 256 * 1024) }
            } ?: return false
            values.clear()
            values.put(MediaStore.Video.Media.IS_PENDING, 0)
            contentResolver.update(uri, values, null, null)
            conn.disconnect()
            return true
        }

        val dir = File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_MOVIES), "QLsu")
        if (!dir.exists()) dir.mkdirs()
        val file = File(dir, name)
        conn.inputStream.use { input ->
            FileOutputStream(file).use { input.copyTo(it, 256 * 1024) }
        }
        conn.disconnect()
        return file.exists()
    }

    private fun toast(msg: String) = Toast.makeText(this, msg, Toast.LENGTH_SHORT).show()
}
