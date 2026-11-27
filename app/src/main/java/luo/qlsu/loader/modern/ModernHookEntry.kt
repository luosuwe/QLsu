package luo.qlsu.loader.modern

import android.content.pm.ApplicationInfo
import android.util.Log
import androidx.annotation.Keep
import io.github.libxposed.api.XposedInterface
import io.github.libxposed.api.XposedInterfaceWrapper
import io.github.libxposed.api.XposedModule
import io.github.libxposed.api.XposedModuleInterface
import luo.qlsu.common.ModuleLoader
import luo.qlsu.loader.hookapi.HookEngineManager
import luo.qlsu.loader.legacy.LegacyHookEngine
import luo.qlsu.hook.other.BgEraserHook
import luo.qlsu.hook.other.WmboxHook
import luo.qlsu.hook.other.XpHooks
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.callMethod
import luo.qlsu.utils.reflect.getObject
import luo.qlsu.utils.reflect.setObject

@Keep
class ModernHookEntry : XposedModule {

    private var processName = ""
    private var isApi100Fallback = false

    /* --- start of API 100 --- */
    constructor(base: XposedInterface, param: XposedModuleInterface.ModuleLoadedParam) {
        // 相当于调用 super(base, param)
        this.setObject("mBase", base, XposedInterfaceWrapper::class.java)
        processName = param.processName
        // 降级为 Legacy API
        isApi100Fallback = true
        
        if (HookEngineManager.isInitialized) return
        HookEngineManager.engine = LegacyHookEngine()
    }

    override fun onPackageLoaded(param: XposedModuleInterface.PackageLoadedParam) {
        if (isApi100Fallback) {
            val packageName = param.packageName
            val base = this.getObject("mBase", XposedInterfaceWrapper::class.java)
            val applicationInfo = base.callMethod("getApplicationInfo") as ApplicationInfo

            if (packageName == HostInfo.PACKAGE_NAME_QQ || packageName == HostInfo.PACKAGE_NAME_TIM) {
                if (param.isFirstPackage) {
                    ModuleLoader.initialize(
                        param.callMethod("getClassLoader") as ClassLoader,
                        applicationInfo.sourceDir,
                        packageName,
                        processName
                    )

                    HookEngineManager.engine.log(
                        Log.INFO,
                        "[QLsu]",
                        "在 API 100 中加载，已降级为 Legacy API"
                    )
                }
            }
        }
    }
    /* --- end of API 100 --- */


    /* --- start of API 101 --- */
    constructor() : super()

    override fun onModuleLoaded(param: XposedModuleInterface.ModuleLoadedParam) {
        super.onModuleLoaded(param)
        this.processName = param.processName
    }

    override fun onPackageReady(param: XposedModuleInterface.PackageReadyParam) {
        super.onPackageReady(param)

        if (HookEngineManager.isInitialized) return

        val packageName = param.packageName

        if (packageName == BgEraserHook.PACKAGE || packageName == WmboxHook.PACKAGE) {
            if (!HookEngineManager.isInitialized) HookEngineManager.engine = ModernHookEngine(this)
            val cl = param.classLoader
            XpHooks.installOnResume(cl) {
                if (packageName == BgEraserHook.PACKAGE) BgEraserHook.install(cl) else WmboxHook.install(cl)
            }
            return
        }

        if (packageName == HostInfo.PACKAGE_NAME_QQ || packageName == HostInfo.PACKAGE_NAME_TIM) {
            if (param.isFirstPackage) {
                HookEngineManager.engine = ModernHookEngine(this)
                
                ModuleLoader.initialize(
                    param.classLoader,
                    moduleApplicationInfo.sourceDir,
                    packageName,
                    processName
                )
            }
        }
    }
    /* --- end of API 101 --- */
}