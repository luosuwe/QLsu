package luo.qlsu

import android.content.ComponentName
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import android.view.WindowManager
import android.widget.Toast
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.activity.enableEdgeToEdge
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.setValue
import androidx.core.net.toUri
import androidx.core.view.WindowCompat
import androidx.lifecycle.Lifecycle
import androidx.lifecycle.lifecycleScope
import androidx.lifecycle.repeatOnLifecycle
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import luo.qlsu.account.AccountInfo
import luo.qlsu.account.AccountStore
import luo.qlsu.account.UserCenterLauncher
import luo.qlsu.video.VideoParseActivity
import luo.qlsu.hook.entry.QlsuEntryHook
import luo.qlsu.ui.components.dialogs.ConfirmDialog
import luo.qlsu.ui.core.theme.QLsuTheme
import luo.qlsu.ui.pages.home.LuoSuLauncherScreen
import luo.qlsu.utils.hook.hookstatus.HookStatus
import luo.qlsu.utils.net.SocialConfigManager
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.ui.ActivityAnim
import luo.qlsu.utils.ui.UiMotion

@Suppress("DEPRECATION")
class MainActivity : ComponentActivity() {

    private var isActivated by mutableStateOf(false)
    private var frameworkInfo by mutableStateOf("")
    private var isIconVisible by mutableStateOf(true)
    private var showHideConfirmDialog by mutableStateOf(false)
    private var account by mutableStateOf<AccountInfo?>(null)
    private var motionEnabled by mutableStateOf(false)

    private val launcherComponent by lazy { ComponentName(this, LauncherActivity::class.java) }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        WindowCompat.setDecorFitsSystemWindows(window, false)
        window.setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_ADJUST_RESIZE)

        // 默认关闭页面过渡动画（可在首页开关里打开）
        motionEnabled = UiMotion.isEnabled(this)
        ActivityAnim.apply(this)
        account = AccountStore.read(this)

        HookStatus.init(this)

        lifecycleScope.launch {
            repeatOnLifecycle(Lifecycle.State.RESUMED) {
                HookStatus.getXposedService().collect {
                    updateActivationStatus()
                    updateIconState()
                }
            }
        }

        lifecycleScope.launch(Dispatchers.IO) {
            SocialConfigManager.fetchSocialConfig()
        }

        setContent {
            QLsuTheme(false) {
                luo.qlsu.ui.luosu.LuoSuGlassRoot { LuoSuLauncherScreen(
                    versionName = BuildConfig.VERSION_NAME,
                    versionCode = BuildConfig.VERSION_CODE,
                    isActivated = isActivated,
                    frameworkInfo = frameworkInfo,
                    account = account,
                    motionEnabled = motionEnabled,
                    onUserCenterClick = { UserCenterLauncher.open(this) },
                    onMotionToggle = { enabled ->
                        motionEnabled = enabled
                        UiMotion.setEnabled(this, enabled)
                        if (!enabled) ActivityAnim.disable(this)
                    },
                    onOpenSettings = { openInHost(null) },
                    onOpenSchedule = { openInHost("schedule") },
                    onGithubClick = { jump(SocialConfigManager.githubRepo) },
                    onTelegramClick = { jump(SocialConfigManager.telegramUrl) },
                    onGroupClick = { jump(SocialConfigManager.qqGroupUrl) },
                    onWebsiteClick = { UserCenterLauncher.openUrl(this, UserCenterLauncher.SITE) },
        onVideoParseClick = { startActivity(android.content.Intent(this, VideoParseActivity::class.java)) }
                ) }

                ConfirmDialog(
                    showHideConfirmDialog,
                    "隐藏图标",
                    "确定要隐藏桌面图标吗？\n\n隐藏后您需要通过模块管理器打开设置。\n\n应用将会重启以刷新状态。",
                    "确定",
                    "取消",
                    { showHideConfirmDialog = false },
                    { showHideConfirmDialog = false; toggleIcon(false) }
                )
            }
        }
    }

    override fun onResume() {
        super.onResume()
        // QQ 进程可能刚刚同步了账号（广播写入），回到前台时刷新一次
        account = AccountStore.read(this)
        motionEnabled = UiMotion.isEnabled(this)
    }

    override fun finish() {
        super.finish()
        if (!motionEnabled) ActivityAnim.disable(this)
    }

    private fun updateIconState() {
        val state = packageManager.getComponentEnabledSetting(launcherComponent)
        isIconVisible = state != PackageManager.COMPONENT_ENABLED_STATE_DISABLED
    }

    private fun handleToggleIcon() {
        if (isIconVisible) showHideConfirmDialog = true else toggleIcon(true)
    }

    private fun toggleIcon(enable: Boolean) {
        val newState =
            if (enable) PackageManager.COMPONENT_ENABLED_STATE_ENABLED else PackageManager.COMPONENT_ENABLED_STATE_DISABLED
        try {
            packageManager.setComponentEnabledSetting(launcherComponent, newState, 0)
            Toast.makeText(this, if (enable) "图标已恢复" else "图标已隐藏", Toast.LENGTH_LONG)
                .show()
            isIconVisible = enable
        } catch (_: Exception) {
        }
    }

    private fun jump(url: String) = startActivity(Intent(Intent.ACTION_VIEW, url.toUri()))

    /** 通过 JumpActivity 唤起宿主里的 QLsu 设置页（不往 QQ UI 里加按钮） */
    private fun openInHost(page: String?) {
        val pkg = when {
            isPkgInstalled("com.tencent.mobileqq") -> "com.tencent.mobileqq"
            isPkgInstalled("com.tencent.tim") -> "com.tencent.tim"
            else -> null
        }
        if (pkg == null) {
            Toast.makeText(this, "没有找到 QQ / TIM", Toast.LENGTH_SHORT).show()
            return
        }
        val intent = Intent().apply {
            setClassName(pkg, "com.tencent.mobileqq.activity.JumpActivity")
            putExtra(QlsuEntryHook.EXTRA_OPEN, true)
            if (page != null) putExtra(QlsuEntryHook.EXTRA_PAGE, page)
            addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
        }
        runCatching { startActivity(intent) }
            .onFailure { Toast.makeText(this, "打开失败：${it.message}", Toast.LENGTH_SHORT).show() }
    }

    private fun isPkgInstalled(pkg: String): Boolean =
        runCatching { packageManager.getPackageInfo(pkg, 0); true }.getOrDefault(false)

    private fun updateActivationStatus() {
        isActivated = checkHookStatus()
        updateFrameworkInfo()
    }

    private fun checkHookStatus(): Boolean {
        val isEnabledByLegacyApi = HookStatus.isModuleEnabled() || HostInfo.isInHostProcess
        val isEnabledByLibXposedApi = checkLibXposedStatus()
        return isEnabledByLegacyApi || isEnabledByLibXposedApi
    }

    private fun checkLibXposedStatus(): Boolean {
        val xposedService = HookStatus.getXposedService().value ?: return false
        val targetScope = setOf(HostInfo.PACKAGE_NAME_QQ, HostInfo.PACKAGE_NAME_TIM)
        return xposedService.scope.intersect(targetScope).isNotEmpty()
    }

    private fun updateFrameworkInfo() {
        if (!isActivated) {
            frameworkInfo = HookStatus.getHookProviderNameForLegacyApi()
            return
        }
        val xposedService = HookStatus.getXposedService().value
        frameworkInfo = if (xposedService != null) {
            "${xposedService.frameworkName} ${xposedService.frameworkVersion} (${xposedService.frameworkVersionCode}), API ${xposedService.apiVersion}"
        } else HookStatus.getHookProviderNameForLegacyApi()
    }
}
