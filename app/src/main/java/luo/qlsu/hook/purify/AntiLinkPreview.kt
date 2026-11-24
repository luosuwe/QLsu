package luo.qlsu.hook.purify

import com.tencent.mobileqq.aio.msg.TextMsgContent
import com.tencent.qqnt.kernel.nativeinterface.LinkInfo
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.doNothing
import luo.qlsu.utils.reflect.findMethod
import java.lang.reflect.Method

@HookItemAnnotation(
    "屏蔽链接预览",
    "屏蔽链接文本的预览信息",
    HookCategory.PURIFY
)
object AntiLinkPreview : BaseSwitchHookItem() {

    private lateinit var addPreview: Method

    override fun onInit(): Boolean {
        addPreview = TextMsgContent::class.java
            .findMethod {
                returnType = void
                paramTypes(null, LinkInfo::class.java)
            }
        return super.onInit()
    }

    override fun onHook() {
        addPreview.doNothing(this)
    }
}