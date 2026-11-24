package luo.qlsu.hook.base

import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.TAG

abstract class BaseHookItem {

    val name: String = TAG

    open var isEnable = true

    protected val annotation: HookItemAnnotation? by lazy {
        this::class.java.getAnnotation(HookItemAnnotation::class.java)
    }

    fun isInTargetProcess(): Boolean {
        val target = annotation?.process ?: return true
        if (target.isBlank() || target == "All") return true
        val currentProcess = HostInfo.processName
        return currentProcess == "${HostInfo.packageName}$target"
    }


}