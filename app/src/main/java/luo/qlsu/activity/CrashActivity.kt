package luo.qlsu.activity

import android.os.Bundle
import androidx.activity.OnBackPressedCallback
import androidx.activity.compose.setContent
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.ui.pages.crash.CrashScreen
import luo.qlsu.utils.qq.AppRestartUtils
import luo.qlsu.utils.qq.HostInfo

class CrashActivity : BaseComposeActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        onBackPressedDispatcher.addCallback(this, object : OnBackPressedCallback(true) {
            override fun handleOnBackPressed() {
                restartApp()
            }
        })

        val blamedModule = intent.getStringExtra("blamedModule") ?: "Unknown"
        val exceptionType = intent.getStringExtra("exceptionType") ?: "Error"
        val summary = intent.getStringExtra("summary") ?: ""
        val reportPath = intent.getStringExtra("reportPath") ?: ""
        val stackTrace = intent.getStringExtra("stackTrace") ?: ""
        val hostName = intent.getStringExtra("hostName") ?: HostInfo.hostName

        setContent {
            QLsuTheme(isDarkTheme) {
                CrashScreen(
                    hostName = hostName,
                    blamedModule = blamedModule,
                    exceptionType = exceptionType,
                    summary = summary,
                    reportPath = reportPath,
                    stackTrace = stackTrace,
                    onRestart = ::restartApp,
                )
            }
        }
    }

    private fun restartApp() {
        AppRestartUtils.restartApp(this, "恢复中...")
    }

}
