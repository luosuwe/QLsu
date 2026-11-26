package luo.qlsu.utils.qq

import android.app.Activity
import android.content.Context
import android.content.SharedPreferences
import com.tencent.mobileqq.app.BusinessHandler
import com.tencent.mobileqq.app.QQAppInterface
import com.tencent.mobileqq.qroute.QRoute
import com.tencent.mobileqq.qroute.QRouteApi
import com.tencent.qqnt.kernel.api.IKernelService
import com.tencent.qqnt.kernel.api.impl.KernelServiceImpl
import luo.qlsu.utils.reflect.callStaticMethod
import luo.qlsu.utils.reflect.getObject
import luo.qlsu.utils.reflect.toClass
import mqq.app.MobileQQ
import mqq.app.api.IRuntimeService

@Suppress("DEPRECATION")
object QQCurrentEnv {

    val globalPreference: SharedPreferences by lazy {
        HostInfo.hostContext.getSharedPreferences(
            "QLsu_Config_global",
            Context.MODE_MULTI_PROCESS
        )
    }

    val qQAppInterface
        get() = MobileQQ.getMobileQQ().peekAppRuntime() as QQAppInterface

    val activity: Activity?
        get() = runCatching {

            val activityThreadClass = "android.app.ActivityThread".toClass
            val activityThread = activityThreadClass.callStaticMethod("currentActivityThread")
            val activities =
                activityThread?.getObject("mActivities") as? Map<*, *>
                    ?: return@runCatching null

            activities.values.firstNotNullOfOrNull { record ->
                record ?: return@firstNotNullOfOrNull null

                val paused = record.getObject("paused") as Boolean
                if (!paused) {
                    record.getObject("activity") as Activity
                } else {
                    null
                }
            }
        }.getOrNull()


    val currentDir: String
        get() = "${HostInfo.moduleDataPath}$currentUin/"

    val currentUin: String
        get() {
            // QQ / TIM 通用：多种方式取当前 QQ 号，取到纯数字才算有效
            candidates().forEach { value ->
                val uin = value?.trim().orEmpty()
                if (uin.matches(Regex("^\\d{4,12}$"))) return uin
            }
            return globalPreference.getString("currentUin", "").orEmpty()
        }

    private fun candidates(): List<String?> {
        val list = mutableListOf<String?>()
        list.add(runCatching { qQAppInterface.currentUin }.getOrNull())
        list.add(runCatching {
            val cls = Class.forName("com.tencent.mobileqq.app.MobileQQ", false, luo.qlsu.utils.reflect.ClassUtils.hostClassLoader)
            val mobileQQ = cls.getMethod("getMobileQQ").invoke(null)
            val runtime = runCatching { cls.getMethod("peekAppRuntime").invoke(mobileQQ) }
                .getOrElse { cls.getMethod("getAppRuntime").invoke(mobileQQ) }
            val names = listOf("getCurrentAccountUin", "getAccount", "getCurrentUin", "getUin")
            names.firstNotNullOfOrNull { name ->
                runCatching {
                    runtime?.javaClass?.methods
                        ?.firstOrNull { it.name == name && it.parameterCount == 0 }
                        ?.invoke(runtime) as? String
                }.getOrNull()?.takeIf { it.isNotBlank() }
            }
        }.getOrNull())
        list.add(runCatching {
            HostInfo.hostContext.getSharedPreferences("com.tencent.mobileqq_preferences", 0)
                .getString("uin", null)
        }.getOrNull())
        list.add(runCatching {
            HostInfo.hostContext.getSharedPreferences("com.tencent.mobileqq_preferences", 0)
                .getString("last_login_uin", null)
        }.getOrNull())
        return list
    }

    val currentNickName: String?
        get() = qQAppInterface.currentNickname

    val kernelMsgService
        get() = runCatching {

            val kernelService = runtime<IKernelService>() as KernelServiceImpl
            kernelService.msgService.service

        }.getOrNull()

    val kernelGroupService
        get() = runCatching {

            val kernelService = runtime<IKernelService>() as KernelServiceImpl
            kernelService.groupService.service

        }.getOrNull()

}


internal inline fun <reified T : QRouteApi> api(): T {
    return QRoute.api(T::class.java)
}

internal inline fun <reified T : IRuntimeService> runtime(): T {
    return QQCurrentEnv.qQAppInterface.getRuntimeService(T::class.java, "")
}

internal inline fun <reified T : BusinessHandler> handler(): BusinessHandler {
    return QQCurrentEnv.qQAppInterface.getBusinessHandler(T::class.java.name)
}