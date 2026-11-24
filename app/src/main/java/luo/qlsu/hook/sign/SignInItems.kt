package luo.qlsu.hook.sign

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.autodaily.store.ScheduledTaskStore
import luo.qlsu.hook.base.BaseSwitchHookItem

/**
 * 「签到」分类：每个签到项一个开关。
 * 打开后把对应任务写进 AutoDaily 的每日调度（每天 08:00 执行），关闭则停用。
 */
abstract class BaseSignInItem(val taskId: String) : BaseSwitchHookItem(true)

@HookItemAnnotation(
    tag = "QQ会员签到",
    desc = "每天自动签到 QQ 会员",
    category = HookCategory.SIGN
)
object SignQqVip : BaseSignInItem("QQ会员")

@HookItemAnnotation(
    tag = "超级会员签到",
    desc = "每天自动签到超级会员",
    category = HookCategory.SIGN
)
object SignSvip : BaseSignInItem("超级会员")

@HookItemAnnotation(
    tag = "大会员签到",
    desc = "每天自动签到大会员",
    category = HookCategory.SIGN
)
object SignBigVip : BaseSignInItem("大会员")

@HookItemAnnotation(
    tag = "黄钻签到",
    desc = "每天自动签到黄钻",
    category = HookCategory.SIGN
)
object SignYellowDiamond : BaseSignInItem("黄钻")

@HookItemAnnotation(
    tag = "QQ打卡",
    desc = "每天自动 QQ 打卡",
    category = HookCategory.SIGN
)
object SignQqClock : BaseSignInItem("QQ打卡")

@HookItemAnnotation(
    tag = "情侣空间签到",
    desc = "每天自动签到情侣空间",
    category = HookCategory.SIGN
)
object SignCoupleSpace : BaseSignInItem("情侣空间")

@HookItemAnnotation(
    tag = "王者荣耀签到",
    desc = "每天自动签到王者荣耀",
    category = HookCategory.SIGN
)
object SignHonorOfKings : BaseSignInItem("王者荣耀")

/** 把开关状态同步到 AutoDaily 的每日调度（只在 QQ 进程里调用） */
object SignInSync {

    private const val CRON = "0 0 8 * * *"

    val all: List<BaseSignInItem> = listOf(
        SignQqVip, SignSvip, SignBigVip, SignYellowDiamond,
        SignQqClock, SignCoupleSpace, SignHonorOfKings
    )

    fun applyAll() {
        all.forEach { item ->
            runCatching {
                if (item.isEnable) {
                    if (ScheduledTaskStore.find(item.taskId) == null) {
                        ScheduledTaskStore.add(item.taskId, CRON)
                    }
                    ScheduledTaskStore.setEnabled(item.taskId, true)
                } else if (ScheduledTaskStore.find(item.taskId) != null) {
                    ScheduledTaskStore.setEnabled(item.taskId, false)
                }
            }
        }
    }
}
