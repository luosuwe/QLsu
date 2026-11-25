package luo.qlsu.hook.sign

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.autodaily.store.ScheduledTaskStore
import luo.qlsu.hook.base.BaseSwitchHookItem

/**
 * 「签到」分类：每个签到项一个开关。
 * 打开后把对应任务写进 AutoDaily 的每日调度（每天 08:00 执行），关闭则停用。
 * taskId 用 AutoDaily 默认配置里的真实任务名（见 assets/default_conf.yaml）。
 */
abstract class BaseSignInItem(val taskId: String) : BaseSwitchHookItem(true)

@HookItemAnnotation(tag = "QQ会员签到", desc = "每天自动签到 QQ 会员", category = HookCategory.SIGN)
object SignQqVip : BaseSignInItem("QQ会员")

@HookItemAnnotation(tag = "超级会员签到", desc = "每天自动签到 QQ 超级会员", category = HookCategory.SIGN)
object SignSvip : BaseSignInItem("QQ超级会员")

@HookItemAnnotation(tag = "大会员签到", desc = "每天自动签到大会员官网", category = HookCategory.SIGN)
object SignBigVip : BaseSignInItem("大会员官网签到")

@HookItemAnnotation(tag = "黄钻签到", desc = "每天自动签到 QQ 黄钻", category = HookCategory.SIGN)
object SignYellowDiamond : BaseSignInItem("QQ黄钻")

@HookItemAnnotation(tag = "QQ打卡", desc = "每天自动 QQ 打卡", category = HookCategory.SIGN)
object SignQqClock : BaseSignInItem("QQ打卡（左上角）")

@HookItemAnnotation(tag = "情侣空间签到", desc = "每天自动签到情侣空间", category = HookCategory.SIGN)
object SignCoupleSpace : BaseSignInItem("情侣空间打卡")

@HookItemAnnotation(tag = "王者荣耀签到", desc = "每天自动签到王者营地", category = HookCategory.SIGN)
object SignHonorOfKings : BaseSignInItem("王者营地签到")

/** 把开关状态同步到 AutoDaily 的每日调度（只在 QQ 进程里调用） */
object SignInSync {

    private const val PREFS = "QLsu_Config_global"

    /** 每日执行时间，默认 00:00，可在模块里设置 */
    private fun cron(): String {
        val prefs = runCatching {
            luo.qlsu.utils.qq.HostInfo.hostContext.getSharedPreferences(PREFS, android.content.Context.MODE_MULTI_PROCESS)
        }.getOrNull()
        val h = prefs?.getInt("sign_hour", 0) ?: 0
        val m = prefs?.getInt("sign_min", 0) ?: 0
        return "0 $m $h * * *"
    }

    val all: List<BaseSignInItem> = listOf(
        SignQqVip, SignSvip, SignBigVip, SignYellowDiamond,
        SignQqClock, SignCoupleSpace, SignHonorOfKings
    )

    fun applyAll() {
        all.forEach { item ->
            runCatching {
                val id = item.taskId
                if (item.isEnable) {
                    if (ScheduledTaskStore.find(id) == null) {
                        ScheduledTaskStore.add(id, cron())
                    }
                    ScheduledTaskStore.setEnabled(id, true)
                } else if (ScheduledTaskStore.find(id) != null) {
                    ScheduledTaskStore.setEnabled(id, false)
                }
            }
        }
    }
}
