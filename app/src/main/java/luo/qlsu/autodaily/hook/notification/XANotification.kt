package luo.qlsu.autodaily.hook.notification

import android.annotation.SuppressLint
import android.app.Notification
import android.app.NotificationChannel
import android.app.NotificationManager
import android.content.Context
import android.os.Build
import androidx.core.app.NotificationCompat
import luo.qlsu.autodaily.hook.base.hostContext
import luo.qlsu.autodaily.ui.ConfUnit
import java.util.concurrent.atomic.AtomicInteger

/**
 * 任务执行期间的前台通知。原版借用模块资源与宿主 SplashActivity，
 * 这里改成纯系统图标 / 无 PendingIntent，避免依赖资源注入是否成功。
 */
object XANotification {

    private const val NOTIFICATION_ID = 0x9AD0
    private const val CHANNEL_ID = "luo.qlsu.autodaily.task"

    private val atomicId = AtomicInteger(1)

    private val notificationManager by lazy {
        hostContext.getSystemService(Context.NOTIFICATION_SERVICE) as NotificationManager
    }

    private var builder: NotificationCompat.Builder? = null
    private var isStart = false

    private val enabled: Boolean
        get() = runCatching { ConfUnit.enableTaskNotification }.getOrDefault(true)

    fun start() {
        if (isStart) return
        runCatching {
            createChannel()
            builder = NotificationCompat.Builder(hostContext, CHANNEL_ID)
                .setContentTitle("QLsu 自动任务")
                .setSmallIcon(android.R.drawable.stat_notify_sync)
                .setOngoing(true)
                .setShowWhen(true)
                .setPriority(Notification.PRIORITY_LOW)
                .setSilent(true)
            isStart = true
        }
    }

    @SuppressLint("NotificationPermission")
    fun setContent(
        content: String,
        onGoing: Boolean = true,
        bigText: Boolean = false,
        isTask: Boolean = true
    ) {
        if (isTask && !enabled) return
        if (!isStart) start()
        val b = builder ?: return
        runCatching {
            if (bigText) {
                b.setStyle(NotificationCompat.BigTextStyle().bigText(content))
            }
            b.setContentText(content)
            b.setOngoing(onGoing)
            b.setWhen(System.currentTimeMillis())
            val id = if (isTask) NOTIFICATION_ID else atomicId.getAndIncrement()
            notificationManager.notify(id, b.build())
        }
    }

    fun notify(content: String) {
        setContent(content, onGoing = false, bigText = false, isTask = false)
    }

    fun stop() {
        if (!isStart) return
        runCatching { notificationManager.cancel(NOTIFICATION_ID) }
        isStart = false
    }

    fun cancelAll() {
        if (!isStart) return
        runCatching { notificationManager.cancelAll() }
        isStart = false
    }

    private fun createChannel() {
        if (Build.VERSION.SDK_INT < Build.VERSION_CODES.O) return
        val channel = NotificationChannel(
            CHANNEL_ID,
            "自动任务",
            NotificationManager.IMPORTANCE_LOW
        ).apply {
            enableLights(false)
            enableVibration(false)
            setShowBadge(false)
            setSound(null, null)
        }
        notificationManager.createNotificationChannel(channel)
    }
}
