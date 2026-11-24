package luo.qlsu.hook.purify

import com.tencent.aio.frame.drawer.DrawerFrameViewGroup
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.replaceFirstParam
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findMethod
import java.lang.reflect.Method

@HookItemAnnotation(
    "屏蔽聊天右滑",
    "屏蔽聊天界面右滑显示的界面",
    HookCategory.PURIFY
)
object BlockRightSwipe : BaseSwitchHookItem() {

    private lateinit var index: Method

    override fun onInit(): Boolean {
        if (HostInfo.isTIM) return false
        index = DrawerFrameViewGroup::class.java
            .findMethod {
                visibility = private
                returnType = void
                paramTypes(int)
            }
        return super.onInit()
    }

    override fun onHook() {
        index.replaceFirstParam(0, this)
    }

}