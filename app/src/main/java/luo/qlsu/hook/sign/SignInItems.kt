package luo.qlsu.hook.sign

import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.qq.QQCurrentEnv

/**
 * 「签到」分类：群签到 / 金币系统（QEdge 同款逻辑）。
 * 开关只控制功能与查询，实际签到在群内发送「签到」触发。
 */
abstract class BaseSignInItem(val prefKey: String, defaultEnable: Boolean = true) :
    BaseSwitchHookItem(defaultEnable)

@HookItemAnnotation(
    tag = "群签到系统",
    desc = "群内发送「签到」得金币，支持自定义/定值/随机金币",
    category = HookCategory.SIGN
)
object SignGroupCoin : BaseSignInItem("signin_enabled", true)

@HookItemAnnotation(
    tag = "查询我的金币",
    desc = "群内发送「我的金币」返回当前金币与签到天数",
    category = HookCategory.SIGN
)
object SignQueryCoins : BaseSignInItem("signin_query_enabled", true)

object SignInSync {
    val all: List<BaseSignInItem> = listOf(SignGroupCoin, SignQueryCoins)

    fun applyAll() {
        all.forEach { item ->
            runCatching {
                QQCurrentEnv.globalPreference.edit()
                    .putBoolean(
                        if (item === SignGroupCoin) "signin_enabled" else "signin_query_enabled",
                        item.isEnable
                    ).apply()
            }
        }
    }
}
