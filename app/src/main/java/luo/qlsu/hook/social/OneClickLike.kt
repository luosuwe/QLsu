package luo.qlsu.hook.social

import com.tencent.mobileqq.app.CardHandler
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.autodaily.hook.function.proxy.FunctionPool
import luo.qlsu.common.ModuleScope
import luo.qlsu.utils.log.LogUtils
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.qq.FriendTool
import luo.qlsu.utils.hook.hookReplace
import luo.qlsu.utils.hook.invokeOriginal
import luo.qlsu.utils.reflect.findMethod
import java.lang.reflect.Method

@HookItemAnnotation(
    "一键点赞",
    "一次性点赞至每天上限次数",
    HookCategory.SOCIAL
)
object OneClickLike : BaseSwitchHookItem() {

    private lateinit var sendZan: Method

    override fun onInit(): Boolean {
        sendZan = CardHandler::class.java
            .findMethod {
                returnType = void
                paramTypes(long, long, byteArr, int, int, int)
            }
        return super.onInit()
    }

    override fun onHook() {

        sendZan.hookReplace(this) { param ->
            LikeDiagnostics.appendDiag(
                "OneClickLike fired method=${sendZan.name} args=" + (param.args?.joinToString { it?.toString() ?: "null" } ?: "null")
            )
            // 每天上限 20：两次 10 连发即可，不再发第 3~5 次（会返回 1001 已上限）
            param.args[4] = 10
            repeat(2) { param.invokeOriginal() }
            null
        }
    }
}