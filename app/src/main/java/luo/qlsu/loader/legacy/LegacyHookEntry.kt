package luo.qlsu.loader.legacy

import androidx.annotation.Keep
import de.robv.android.xposed.IXposedHookLoadPackage
import de.robv.android.xposed.IXposedHookZygoteInit
import de.robv.android.xposed.callbacks.XC_LoadPackage
import luo.qlsu.BuildConfig
import luo.qlsu.common.ModuleLoader
import luo.qlsu.loader.hookapi.HookEngineManager
import luo.qlsu.hook.other.BgEraserHook
import luo.qlsu.utils.qq.HostInfo

@Keep
class LegacyHookEntry : IXposedHookLoadPackage, IXposedHookZygoteInit {

    private var modulePath: String = ""

    override fun initZygote(startupParam: IXposedHookZygoteInit.StartupParam) {
        modulePath = startupParam.modulePath
    }

    override fun handleLoadPackage(lpparam: XC_LoadPackage.LoadPackageParam) {
        val packageName = lpparam.packageName

        if (packageName == BuildConfig.APPLICATION_ID) {
            LegacyHookStatusInit.init(lpparam.classLoader)
        }

        if (packageName == BgEraserHook.PACKAGE) {
            runCatching { BgEraserHook.install(lpparam.classLoader) }
            return
        }

        if (packageName == HostInfo.PACKAGE_NAME_QQ || packageName == HostInfo.PACKAGE_NAME_TIM) {
            
            if (HookEngineManager.isInitialized) return

            HookEngineManager.engine = LegacyHookEngine()
            
            ModuleLoader.initialize(
                lpparam.classLoader,
                modulePath,
                packageName,
                lpparam.processName
            )
        }
    }
}