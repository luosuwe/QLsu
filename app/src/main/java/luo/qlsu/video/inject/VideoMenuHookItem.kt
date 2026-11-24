package luo.qlsu.video.inject

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.qq.HostInfo

/**
 * 视频解析菜单注入：只对抖音 / 快手 / 哔哩哔哩生效（需要在 LSPosed 里把作用域勾上这些 App）。
 * 在分享面板里加一个「视频解析」按钮，点击打开模块的解析页。
 */
@HookItemAnnotation(
    tag = "视频解析菜单",
    desc = "在抖音 / 快手 / 哔哩哔哩的分享面板加入「视频解析」按钮",
    category = HookCategory.OTHER
)
object VideoMenuHookItem : BaseSwitchHookItem(true) {

    private val targets = setOf(
        "com.ss.android.ugc.aweme",
        "com.smile.gifmaker",
        "com.kuaishou.nebula",
        "tv.danmaku.bili",
        "com.bilibili.app.in",
    )

    override fun onInit(): Boolean = HostInfo.packageName in targets

    override fun onHook() {
        VideoMenuInjector.install()
    }
}
