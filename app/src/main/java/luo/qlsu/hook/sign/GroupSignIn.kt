package luo.qlsu.hook.sign

import com.tencent.qqnt.kernel.nativeinterface.MsgRecord
import luo.qlsu.hook.api.ReceiveMsgListener
import luo.qlsu.utils.qq.MsgTool
import luo.qlsu.utils.qq.QQCurrentEnv
import java.text.SimpleDateFormat
import java.util.Date
import java.util.Locale

/**
 * 群签到 / 金币系统（参考 QEdge 的 SignInFeature 实现）：
 * 群内发送「签到」即可签到得金币，数据按 群号 + QQ 号 存在宿主偏好里。
 *
 * 支持的命令：
 *   签到
 *   我的金币
 *   开启签到系统 / 关闭签到系统
 *   设置签到金币随机
 *   设置签到金币自定义#min#max
 *   设置签到金币定值#n
 */
object GroupSignIn : ReceiveMsgListener {

    private const val ENABLE_KEY = "signin_enabled"
    private const val QUERY_KEY = "signin_query_enabled"

    private fun prefs() = QQCurrentEnv.globalPreference
    private fun day(): String =
        SimpleDateFormat("yyyy-MM-dd", Locale.CHINA).format(Date())

    private fun groupEnabled(group: String) = prefs().getBoolean("signin_group_$group", true)
    private fun mode(group: String) = prefs().getString("signin_mode_$group", "random") ?: "random"
    private fun minCoin(group: String) = prefs().getInt("signin_min_$group", 100)
    private fun maxCoin(group: String) = prefs().getInt("signin_max_$group", 999)
    private fun fixedCoin(group: String) = prefs().getInt("signin_fixed_$group", 100)
    private fun coins(group: String, uin: String) = prefs().getInt("signin_coins_${group}_$uin", 0)
    private fun days(group: String, uin: String) = prefs().getInt("signin_days_${group}_$uin", 0)
    private fun lastDay(group: String, uin: String) = prefs().getString("signin_day_${group}_$uin", "")

    private fun reply(group: String, text: String) {
        runCatching { MsgTool.sendMsg(group, text, 2) }
    }

    override fun onReceive(msgRecord: MsgRecord) {
        runCatching {
            if (msgRecord.chatType != 2) return
            if (!prefs().getBoolean(ENABLE_KEY, true)) return

            val group = msgRecord.peerUin.toString()
            val uin = msgRecord.senderUin.toString()
            if (group.isBlank() || uin.isBlank()) return

            val text = msgRecord.elements
                ?.firstOrNull()?.textElement?.content?.trim()
                ?: return
            if (text.isEmpty()) return

            if (text == "开启签到系统" || text == "关闭签到系统") {
                val on = text == "开启签到系统"
                prefs().edit().putBoolean("signin_group_$group", on).apply()
                reply(group, if (on) "已开启本群签到系统" else "已关闭本群签到系统")
                return
            }

            if (text == "设置签到金币随机") {
                prefs().edit().putString("signin_mode_$group", "random").apply()
                reply(group, "设置成功！当前签到金币：${minCoin(group)}~${maxCoin(group)}")
                return
            }

            if (text.startsWith("设置签到金币自定义#")) {
                val parts = text.removePrefix("设置签到金币自定义#").split("#")
                if (parts.size >= 2) {
                    val min = parts[0].toIntOrNull()
                    val max = parts[1].toIntOrNull()
                    if (min != null && max != null && min > 0 && max >= min) {
                        prefs().edit()
                            .putString("signin_mode_$group", "custom")
                            .putInt("signin_min_$group", min)
                            .putInt("signin_max_$group", max)
                            .apply()
                        reply(group, "设置成功！当前签到金币：$min~$max")
                        return
                    }
                }
                reply(group, "格式错误，正确格式：设置签到金币自定义#最小值#最大值")
                return
            }

            if (text.startsWith("设置签到金币定值#")) {
                val v = text.removePrefix("设置签到金币定值#").toIntOrNull()
                if (v != null && v > 0) {
                    prefs().edit()
                        .putString("signin_mode_$group", "fixed")
                        .putInt("signin_fixed_$group", v)
                        .apply()
                    reply(group, "设置成功！当前签到金币：$v")
                } else {
                    reply(group, "格式错误，正确格式：设置签到金币定值#数值")
                }
                return
            }

            if (text == "我的金币") {
                if (!prefs().getBoolean(QUERY_KEY, true)) return
                reply(
                    group,
                    "QQ：$uin\n当前金币：${coins(group, uin)}\n已签到${days(group, uin)}天"
                )
                return
            }

            if (text == "签到") {
                if (!groupEnabled(group)) return
                val today = day()
                val got = coins(group, uin)
                val d = days(group, uin)
                if (lastDay(group, uin) == today) {
                    reply(group, "QQ：$uin\n今日已签过到！\n当前金币：$got\n已签到${d}天")
                    return
                }
                val add = when (mode(group)) {
                    "fixed" -> fixedCoin(group)
                    "custom" -> {
                        val min = minCoin(group)
                        val max = maxCoin(group).coerceAtLeast(min)
                        min + (Math.random() * (max - min + 1)).toInt()
                    }
                    else -> 100 + (Math.random() * 900).toInt()
                }
                val total = got + add
                prefs().edit()
                    .putInt("signin_coins_${group}_$uin", total)
                    .putInt("signin_days_${group}_$uin", d + 1)
                    .putString("signin_day_${group}_$uin", today)
                    .apply()
                reply(
                    group,
                    "QQ：$uin\n签到成功！\n获得金币：$add\n当前金币：$total\n已签到${d + 1}天"
                )
            }
        }
    }
}
