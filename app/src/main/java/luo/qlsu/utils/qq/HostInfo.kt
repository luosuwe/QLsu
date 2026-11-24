package luo.qlsu.utils.qq

import android.annotation.SuppressLint
import android.content.Context
import android.os.Build

@Suppress("DEPRECATION")
@SuppressLint("StaticFieldLeak")
object HostInfo {
    const val PACKAGE_NAME_QQ = "com.tencent.mobileqq"
    const val PACKAGE_NAME_TIM = "com.tencent.tim"

    lateinit var hostContext: Context
        private set

    var packageName = ""

    var hostName: String = "Host App"
        private set

    lateinit var processName: String

    val isQQ: Boolean
        get() = packageName == PACKAGE_NAME_QQ
    val isTIM: Boolean
        get() = packageName == PACKAGE_NAME_TIM

    val isInHostProcess: Boolean
        get() = isQQ || isTIM
    var versionCode: Long = 0
        private set
    var versionName: String = ""
        private set
    var moduleDataPath: String = ""
        private set

    @JvmStatic
    fun init(context: Context) {
        hostContext = context
        packageName = context.packageName
        processName = runCatching {
            if (Build.VERSION.SDK_INT >= 28) {
                android.app.Application.getProcessName()
            } else {
                Class.forName("android.app.ActivityThread")
                    .getMethod("currentProcessName")
                    .invoke(null) as String
            }
        }.getOrNull().orEmpty().ifBlank { context.packageName }

        runCatching {
            val pm = context.packageManager
            val info = pm.getPackageInfo(context.packageName, 0)
            versionCode =
                if (Build.VERSION.SDK_INT > 28)
                    info.longVersionCode
                else
                    info.versionCode.toLong()
            versionName = info.versionName.orEmpty()
            val appInfo = pm.getApplicationInfo(packageName, 0)
            hostName = pm.getApplicationLabel(appInfo).toString()
        }

        val externalDir = context.getExternalFilesDir(null)?.parentFile
        moduleDataPath = externalDir?.let { "${it.absolutePath}/QLsu/" }
            ?: "/storage/emulated/0/Android/data/${context.packageName}/QLsu/"
    }

}