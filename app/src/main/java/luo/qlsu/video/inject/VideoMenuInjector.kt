package luo.qlsu.video.inject

import android.app.Activity
import android.app.AlertDialog
import android.content.Context
import android.content.Intent
import android.graphics.Color
import android.os.Handler
import android.os.Looper
import android.text.TextUtils
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.qq.HostInfo
import java.lang.reflect.Method

/**
 * 在目标 App（抖音 / 快手 / 哔哩哔哩）的分享面板里插入「视频解析」按钮。
 *
 * 思路（版本无关的兜底方案）：
 * 1. Hook 分享 Intent 的创建（Activity.startActivity），拿到当前视频的分享文案（含链接）；
 * 2. Hook Dialog.show，面板弹出后遍历视图树，找到「分享 / 复制链接 / 保存 / 更多」这类按钮所在的容器；
 * 3. 往容器里追加一个「视频解析」按钮，点击后带链接打开模块的视频解析页。
 *
 * 全程 try/catch，注入失败只是没有按钮，不会影响目标 App。
 */
object VideoMenuInjector {

    private const val TAG = "qlsu_video_parse"

    private val TARGETS = setOf(
        "com.ss.android.ugc.aweme",      // 抖音
        "com.smile.gifmaker",            // 快手
        "com.kuaishou.nebula",           // 快手极速版
        "tv.danmaku.bili",               // 哔哩哔哩
        "com.bilibili.app.in",           // 哔哩哔哩国际版
    )

    @Volatile
    private var lastShareText: String = ""

    @Volatile
    private var lastShareAt: Long = 0L

    fun install() {
        if (HostInfo.packageName !in TARGETS) return
        runCatching { hookShareIntent() }
        runCatching { hookDialog() }
    }

    /** 记录最近一次分享文案（里面带视频链接） */
    private fun hookShareIntent() {
        val method: Method = Activity::class.java.getDeclaredMethod("startActivity", Intent::class.java)
        method.hookAfter {
            val intent = it.args.getOrNull(0) as? Intent ?: return@hookAfter
            capture(intent)
        }
    }

    fun capture(intent: Intent) {
        if (intent.action != Intent.ACTION_SEND) return
        if (intent.type?.startsWith("text/") != true) return
        val text = intent.getStringExtra(Intent.EXTRA_TEXT).orEmpty()
        if (text.contains("http")) {
            lastShareText = text
            lastShareAt = System.currentTimeMillis()
        }
    }

    private fun hookDialog() {
        val method: Method = android.app.Dialog::class.java.getDeclaredMethod("show")
        method.hookAfter { param ->
            val dialog = param.thisObject as? android.app.Dialog ?: return@hookAfter
            if (System.currentTimeMillis() - lastShareAt > 3 * 60 * 1000) return@hookAfter
            Handler(Looper.getMainLooper()).postDelayed({
                runCatching { inject(dialog) }
            }, 300)
        }
    }

    private fun inject(dialog: android.app.Dialog) {
        val decor = dialog.window?.decorView ?: return
        if (decor.findViewWithTag<View>(TAG) != null) return

        val container = findShareContainer(decor) ?: return
        val context = dialog.context

        val button = TextView(context).apply {
            tag = TAG
            text = "视频解析"
            textSize = 13f
            setTextColor(Color.parseColor("#E45757"))
            setPadding(28, 20, 28, 20)
            setOnClickListener {
                val text = recentShareText()
                if (text.isNullOrBlank()) {
                    toast(context, "没有拿到视频链接，请先点一次「复制链接」再试")
                } else {
                    openParse(context, text)
                }
                runCatching { dialog.dismiss() }
            }
        }

        runCatching {
            container.addView(button)
        }.onFailure {
            // 容器是横向 / 纵向都能塞，实在塞不进去就算了
        }
    }

    private fun recentShareText(): String? {
        val text = lastShareText
        if (text.isBlank()) return null
        if (System.currentTimeMillis() - lastShareAt > 5 * 60 * 1000) return null
        return text
    }

    /** 在视图树里找「分享面板」：包含多个可点击子项、且能匹配到分享 / 复制链接 / 保存等文案 */
    private fun findShareContainer(root: View): ViewGroup? {
        var best: ViewGroup? = null
        var bestScore = 0

        fun walk(view: View, depth: Int) {
            if (depth > 12 || view !is ViewGroup) return
            var clickableChildren = 0
            var keywordHit = 0
            for (i in 0 until view.childCount) {
                val child = view.getChildAt(i)
                if (child.isClickable) clickableChildren++
                val label = (child.contentDescription?.toString().orEmpty()) + " " + textOf(child)
                if (KEYWORDS.any { label.contains(it) }) keywordHit++
                walk(child, depth + 1)
            }
            val score = clickableChildren + keywordHit * 2
            if (clickableChildren >= 3 && keywordHit >= 1 && score > bestScore) {
                bestScore = score
                best = view
            }
        }

        walk(root, 0)
        return best
    }

    private fun textOf(view: View): String = when (view) {
        is TextView -> view.text?.toString().orEmpty()
        else -> {
            if (view is ViewGroup) {
                val sb = StringBuilder()
                for (i in 0 until view.childCount) sb.append(textOf(view.getChildAt(i))).append(' ')
                sb.toString()
            } else ""
        }
    }

    private val KEYWORDS = listOf("分享", "复制链接", "保存", "下载", "更多", "转发", "收藏")

    private fun openParse(context: Context, text: String) {
        runCatching {
            val intent = Intent(Intent.ACTION_SEND).apply {
                setClassName("luo.QLsu", "luo.qlsu.video.VideoParseActivity")
                type = "text/plain"
                putExtra(Intent.EXTRA_TEXT, text)
                addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
            }
            context.startActivity(intent)
        }.onFailure { toast(context, "打开视频解析失败") }
    }

    private fun toast(context: Context, msg: String) {
        runCatching {
            android.widget.Toast.makeText(context, msg, android.widget.Toast.LENGTH_SHORT).show()
        }
    }
}
