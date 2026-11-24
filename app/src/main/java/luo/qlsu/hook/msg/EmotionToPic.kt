package luo.qlsu.hook.msg

import com.tencent.qqnt.aio.adapter.api.impl.RichMediaBrowserApiImpl
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.returnConstant
import luo.qlsu.utils.reflect.findMethod

@HookItemAnnotation(
    "以图片方式打开表情",
    "将表情包作为普通图片打开，方便下载",
    HookCategory.MSG
)
object EmotionToPic : BaseSwitchHookItem() {

    override fun onHook() {
        RichMediaBrowserApiImpl::class.java
            .findMethod {
                name = "checkIsFavPicAndShowPreview"
            }
            .returnConstant(this, false)
    }
}