package luo.qlsu.hook.sign

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.qq.QQCurrentEnv

/** 「签到」分类：等级加速类签到（QEdge LevelBoost 同款） */
abstract class BaseSignInItem(val prefKey: String, defaultEnable: Boolean = true) :
    BaseSwitchHookItem(defaultEnable)

@HookItemAnnotation(
    tag = "空间等级签到",
    desc = "每天 00:00 自动发一条空间签到说说",
    category = HookCategory.SIGN
)
object SignQzoneClockIn : BaseSignInItem(LevelBoost.SP_CHECKIN, true)

@HookItemAnnotation(
    tag = "QQ日签打卡",
    desc = "每天 00:00 自动完成 QQ 日签（等级加速）",
    category = HookCategory.SIGN
)
object SignDailyAttendance : BaseSignInItem(LevelBoost.SP_DAILY_SIGN, true)

@HookItemAnnotation(
    tag = "大会员签到",
    desc = "每天 00:00 自动完成 QQ 大会员签到（等级加速）",
    category = HookCategory.SIGN
)
object SignBigVip : BaseSignInItem(LevelBoost.SP_BIGVIP, true)

object SignInSync {

    val all: List<BaseSignInItem> = listOf(SignQzoneClockIn, SignDailyAttendance, SignBigVip)

    fun applyAll() {
        LevelBoost.start()
        all.forEach { item ->
            runCatching {
                QQCurrentEnv.globalPreference.edit()
                    .putBoolean(item.prefKey, item.isEnable)
                    .apply()
                if (item.isEnable) LevelBoost.runNowIfEnabled(item.prefKey)
            }
        }
    }
}
