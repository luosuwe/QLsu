package luo.qlsu.video

import android.content.Context
import android.media.MediaScannerConnection
import android.os.Environment
import org.json.JSONObject
import java.io.File
import java.io.FileOutputStream
import java.net.HttpURLConnection
import java.net.URL
import java.net.URLDecoder

/**
 * 视频/图文解析：抖音、快手、哔哩哔哩。
 * 视频返回最高画质直链；图文返回图片列表。
 */
object VideoParser {

    data class VideoInfo(
        val platform: String,
        val title: String,
        val url: String,
        val images: List<String> = emptyList(),
    ) {
        val isImagePost: Boolean get() = images.isNotEmpty() && url.isBlank()
    }

    private const val UA =
        "Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) " +
            "Chrome/120.0.0.0 Mobile Safari/537.36"

    fun parse(text: String): VideoInfo? {
        val url = extractUrl(text) ?: return null
        return runCatching {
            when {
                url.contains("douyin.com") || url.contains("iesdouyin.com") -> douyin(url)
                url.contains("kuaishou.com") || url.contains("chenzhongtech.com") -> kuaishou(url)
                url.contains("bilibili.com") || url.contains("b23.tv") -> bilibili(url)
                else -> null
            }
        }.getOrNull()
    }

    private fun extractUrl(text: String): String? =
        Regex("https?://[^\\s\"'<>]+").find(text)?.value

    private fun follow(url: String): String {
        var current = url
        repeat(5) {
            val conn = (URL(current).openConnection() as HttpURLConnection).apply {
                instanceFollowRedirects = false
                connectTimeout = 12000
                readTimeout = 12000
                setRequestProperty("User-Agent", UA)
            }
            val code = conn.responseCode
            val loc = conn.getHeaderField("Location")
            conn.disconnect()
            if (code in 300..399 && !loc.isNullOrBlank()) {
                current = if (loc.startsWith("http")) loc else URL(URL(current), loc).toString()
            } else {
                return current
            }
        }
        return current
    }

    private fun get(url: String, headers: Map<String, String> = emptyMap()): String {
        val conn = (URL(url).openConnection() as HttpURLConnection).apply {
            connectTimeout = 12000
            readTimeout = 15000
            instanceFollowRedirects = true
            setRequestProperty("User-Agent", UA)
            headers.forEach { (k, v) -> setRequestProperty(k, v) }
        }
        return conn.inputStream.bufferedReader().use { it.readText() }
    }

    // ---------------- 抖音 ----------------
    private fun douyin(link: String): VideoInfo? {
        val finalUrl = follow(link)
        val id = Regex("/video/(\\d+)").find(finalUrl)?.groupValues?.get(1)
            ?: Regex("/note/(\\d+)").find(finalUrl)?.groupValues?.get(1)
            ?: Regex("[?&]modal_id=(\\d+)").find(finalUrl)?.groupValues?.get(1)
            ?: Regex("(\\d{15,25})").find(link)?.groupValues?.get(1)
            ?: return null
        val api = "https://www.iesdouyin.com/web/api/v2/aweme/iteminfo/?item_ids=$id"
        val body = get(api, mapOf("Referer" to "https://www.douyin.com/"))
        val json = JSONObject(body)
        val item = json.optJSONArray("item_list")?.optJSONObject(0) ?: return null
        val title = item.optString("desc").ifBlank { "抖音_$id" }

        val images = mutableListOf<String>()
        item.optJSONArray("images")?.let { arr ->
            for (i in 0 until arr.length()) {
                val u = arr.optJSONObject(i)?.optJSONArray("url_list")?.optString(0).orEmpty()
                if (u.isNotBlank()) images.add(u)
            }
        }

        val play = item.optJSONObject("video")
            ?.optJSONObject("play_addr")
            ?.optJSONArray("url_list")
            ?.optString(0)
            .orEmpty()

        if (play.isBlank() && images.isEmpty()) return null
        val best = play.replace("playwm", "play").replace("&watermark=1", "")
        return VideoInfo("抖音", title, best, images)
    }

    // ---------------- 快手 ----------------
    private fun kuaishou(link: String): VideoInfo? {
        val finalUrl = follow(link)
        val html = get(finalUrl, mapOf("Referer" to "https://www.kuaishou.com/"))
        val video = Regex("\"srcNoMark\"\\s*:\\s*\"([^\"]+)\"").find(html)?.groupValues?.get(1)
            ?: Regex("\"photoUrl\"\\s*:\\s*\"([^\"]+)\"").find(html)?.groupValues?.get(1)

        val images = mutableListOf<String>()
        Regex("\"atlas\"\\s*:\\s*\\[(.*?)\\]", RegexOption.DOT_MATCHES_ALL).find(html)?.let { m ->
            Regex("\"url\"\\s*:\\s*\"([^\"]+)\"").findAll(m.groupValues[1]).forEach {
                images.add(it.groupValues[1].replace("\\/", "/"))
            }
        }

        if (video == null && images.isEmpty()) return null
        val title = Regex("\"caption\"\\s*:\\s*\"([^\"]+)\"").find(html)?.groupValues?.get(1)
            ?.let { runCatching { URLDecoder.decode(it, "UTF-8") }.getOrDefault(it) }
            .orEmpty()
            .ifBlank { "快手内容" }
        val url = video?.replace("\\/", "/").orEmpty()
        return VideoInfo("快手", title, url, images)
    }

    // ---------------- 哔哩哔哩 ----------------
    private fun bilibili(link: String): VideoInfo? {
        val finalUrl = follow(link)
        val bvid = Regex("(BV[0-9A-Za-z]{10})").find(finalUrl)?.groupValues?.get(1)
            ?: Regex("(BV[0-9A-Za-z]{10})").find(link)?.groupValues?.get(1)
            ?: return null
        val headers = mapOf(
            "Referer" to "https://www.bilibili.com/",
            "User-Agent" to "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 " +
                "(KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
        )
        val view = JSONObject(get("https://api.bilibili.com/x/web-interface/view?bvid=$bvid", headers))
        val data = view.optJSONObject("data") ?: return null
        val title = data.optString("title").ifBlank { "B站视频_$bvid" }
        val cid = data.optLong("cid")
        val play = JSONObject(
            get(
                "https://api.bilibili.com/x/player/playurl?bvid=$bvid&cid=$cid&qn=80&fnval=0&platform=html5&high_quality=1",
                headers
            )
        )
        val durl = play.optJSONObject("data")?.optJSONArray("durl")?.optJSONObject(0) ?: return null
        val url = durl.optString("url")
        if (url.isBlank()) return null
        return VideoInfo("哔哩哔哩", title, url)
    }

    // ---------------- 保存 ----------------
    fun save(context: Context, info: VideoInfo): File? {
        val dir = File(
            Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_MOVIES),
            "QLsu"
        ).apply { mkdirs() }
        val safe = info.title.replace(Regex("[\\\\/:*?\"<>|]"), "_").take(60).ifBlank { "video" }
        val file = File(dir, "$safe.mp4")

        val headers = when (info.platform) {
            "哔哩哔哩" -> mapOf(
                "Referer" to "https://www.bilibili.com/",
                "User-Agent" to "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 " +
                    "(KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
            )
            else -> mapOf("User-Agent" to UA)
        }

        val conn = (URL(info.url).openConnection() as HttpURLConnection).apply {
            connectTimeout = 15000
            readTimeout = 30000
            instanceFollowRedirects = true
            headers.forEach { (k, v) -> setRequestProperty(k, v) }
        }
        conn.inputStream.use { input ->
            FileOutputStream(file).use { output -> input.copyTo(output, 256 * 1024) }
        }
        conn.disconnect()

        MediaScannerConnection.scanFile(
            context,
            arrayOf(file.absolutePath),
            arrayOf("video/mp4"),
            null
        )
        return file
    }
}
