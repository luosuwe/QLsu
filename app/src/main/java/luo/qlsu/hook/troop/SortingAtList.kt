package luo.qlsu.hook.troop

import com.tencent.mobileqq.aio.input.at.common.SubmitListEvent
import com.tencent.qqnt.kernel.nativeinterface.MemberInfo
import com.tencent.qqnt.kernelpublic.nativeinterface.MemberRole
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.getObjectByTypeOrNull

@HookItemAnnotation(
    "艾特列表排序",
    "按群主，管理，官机，成员排序艾特列表",
    HookCategory.GROUP
)
object SortingAtList : BaseSwitchHookItem() {

    override fun onHook() {
        SubmitListEvent::class.java
            .findMethod {
                name = "getItemList"
            }.hookAfter(this) { param ->
                val itemList = param.result as List<*>
                val newList = itemList.sortedBy {
                    val memberInfo = it?.getObjectByTypeOrNull<MemberInfo>() ?: return@sortedBy 0
                    if (memberInfo.isRobot) return@sortedBy 3
                    return@sortedBy when (memberInfo.role) {
                        MemberRole.OWNER -> 1
                        MemberRole.ADMIN -> 2
                        MemberRole.MEMBER -> 4
                        else -> 5
                    }
                }
                param.result = newList
            }
    }

}