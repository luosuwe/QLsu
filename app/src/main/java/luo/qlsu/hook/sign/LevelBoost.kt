package luo.qlsu.hook.sign

import luo.qlsu.utils.qq.QQCurrentEnv
import java.io.BufferedReader
import java.io.DataOutputStream
import java.io.InputStreamReader
import java.net.HttpURLConnection
import java.net.URL
import java.text.SimpleDateFormat
import java.util.Date
import java.util.Locale
import java.util.Timer
import java.util.TimerTask
import java.util.concurrent.atomic.AtomicBoolean

/**
 * 等级加速签到（参考 QEdge LevelBoost）：
 *  ① 空间等级签到（qzone 打卡）
 *  ② QQ 日签打卡（ti.qq.com）
 *  ③ 大会员签到
 * 每天 00:00 触发一次；开关「关→开」时立即补跑；按日期在宿主偏好里去重。
 */
object LevelBoost {

    const val SP_CHECKIN = "level_qzone_checkin"
    const val SP_DAILY_SIGN = "level_daily_sign"
    const val SP_BIGVIP = "level_bigvip"

    private val started = AtomicBoolean(false)

    private fun prefs() = QQCurrentEnv.globalPreference
    private fun today(): String =
        SimpleDateFormat("yyyyMMdd", Locale.getDefault()).format(Date())

    private fun done(key: String): Boolean = prefs().getBoolean("${key}_${today()}", false)
    private fun markDone(key: String) {
        prefs().edit().putBoolean("${key}_${today()}", true).apply()
    }

    private fun enabled(key: String) = prefs().getBoolean(key, false)

    fun start() {
        if (!started.compareAndSet(false, true)) return
        Timer("QLsu_LevelBoost", true).schedule(object : TimerTask() {
            override fun run() = tick()
        }, 5000L, 60_000L)
    }

    private fun tick() {
        runCatching {
            val hm = SimpleDateFormat("HH:mm", Locale.getDefault()).format(Date())
            val now = hm == "00:00" || hm == "00:01"
            if (enabled(SP_CHECKIN) && !done(SP_CHECKIN) && now) runCheckin()
            if (enabled(SP_DAILY_SIGN) && !done(SP_DAILY_SIGN) && now) runDailySign()
            if (enabled(SP_BIGVIP) && !done(SP_BIGVIP) && now) runBigVip()
        }
    }

    /** 开关打开时立即补跑一次 */
    fun runNowIfEnabled(key: String) {
        runCatching {
            when (key) {
                SP_CHECKIN -> if (!done(SP_CHECKIN)) runCheckin()
                SP_DAILY_SIGN -> if (!done(SP_DAILY_SIGN)) runDailySign()
                SP_BIGVIP -> if (!done(SP_BIGVIP)) runBigVip()
            }
        }
    }

    // ---------------- 空间签到 ----------------
    private fun runCheckin() {
        Thread {
            val uin = QQCurrentEnv.currentUin
            val skey = TicketTool.skey()
            val pskey = TicketTool.pskey("qzone.qq.com")
            if (uin.isBlank() || skey.isNullOrBlank() || pskey.isNullOrBlank()) return@Thread
            val gtk = TicketTool.bkn(pskey)
            val urlStr = "https://h5.qzone.qq.com/webapp/json/publishDiyMood/publishmood?g_tk=$gtk"
            val content = "QLsu每日空间签到"
            val body = """{"uin":$uin,"content":"$content","format":"json","inCharset":"utf-8","outCharset":"utf-8","richtype":"1","richval":"","source":{"subtype":"33"},"stored_extend_info":{"is_diy":"1","event_tags":"${uin}_QLsu_签到","use_useragent_tail":"1"}}"""
            val cookie = "uin=o$uin; skey=$skey; p_uin=o$uin; p_skey=$pskey"
            val r = post("$urlStr", body, cookie, "https://user.qzone.qq.com/")
            if (r.contains("\"code\":0") || r.contains("\"ret\":0")) markDone(SP_CHECKIN)
        }.start()
    }

    // ---------------- QQ 日签 ----------------
    private fun runDailySign() {
        Thread {
            val uin = QQCurrentEnv.currentUin
            val skey = TicketTool.skey()
            val pskey = TicketTool.pskey("ti.qq.com")
            if (uin.isBlank() || skey.isNullOrBlank() || pskey.isNullOrBlank()) return@Thread
            val cookie = "uin=o$uin; skey=$skey; p_uin=o$uin; p_skey=$pskey"
            val ads = """{"app":"QQ","os":"Android","version":"8.8.93","imei":""}"""
            val body = """{"uin":"$uin","type":1,"sId":"","qua":"V1_AND_SQ_8.8.93_2862_HDBM_T","mpExtend":{"tianshuAdsReq":"${ads.replace("\"", "\\\"")}"}}"""
            val r = post(
                "https://ti.qq.com/hybrid-h5/api/json/daily_attendance/SignIn",
                body, cookie, "https://ti.qq.com/"
            )
            if (r.contains("\"ret\":0") || r.contains("\"code\":0") || r.contains("成功")) markDone(SP_DAILY_SIGN)
        }.start()
    }

    // ---------------- 大会员签到 ----------------
    private fun runBigVip() {
        Thread {
            val uin = QQCurrentEnv.currentUin
            val skey = TicketTool.skey()
            val pskey = TicketTool.pskey("qzone.qq.com")
            if (uin.isBlank() || skey.isNullOrBlank() || pskey.isNullOrBlank()) return@Thread
            val gtk = TicketTool.bkn(pskey)
            val cookie = "uin=o$uin; skey=$skey; p_uin=o$uin; p_skey=$pskey"
            val body = "appid=qq_big_vip&op=CheckIn&format=json&inCharset=utf-8&outCharset=utf-8"
            val r = post(
                "https://h5.qzone.qq.com/p/vip/fcg-bin/v2/fcg_vip_task_checkin?g_tk=$gtk",
                body, cookie, "https://h5.qzone.qq.com/"
            )
            if (r.contains("\"ret\":0") || r.contains("\"code\":0") || r.contains("成功") || r.contains("success")) {
                markDone(SP_BIGVIP)
            }
        }.start()
    }

    private fun post(urlStr: String, data: String, cookie: String, referer: String): String {
        var reader: BufferedReader? = null
        return try {
            val conn = URL(urlStr).openConnection() as HttpURLConnection
            conn.requestMethod = "POST"
            conn.connectTimeout = 10000
            conn.readTimeout = 10000
            conn.doOutput = true
            conn.setRequestProperty("Content-Type", "application/json; charset=UTF-8")
            conn.setRequestProperty("Cookie", cookie)
            conn.setRequestProperty(
                "User-Agent",
                "Mozilla/5.0 (Linux; Android 12) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/89.0.4389.72 Mobile Safari/537.36"
            )
            conn.setRequestProperty("Referer", referer)
            DataOutputStream(conn.outputStream).use { it.write(data.toByteArray(Charsets.UTF_8)) }
            reader = BufferedReader(InputStreamReader(conn.inputStream, "UTF-8"))
            reader.readText()
        } catch (t: Throwable) {
            ""
        } finally {
            runCatching { reader?.close() }
        }
    }
}
