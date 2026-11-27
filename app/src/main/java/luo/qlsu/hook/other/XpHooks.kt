package luo.qlsu.hook.other

import luo.qlsu.loader.hookapi.HookEngineManager

/**
 * 统一的 Hook 工具：不依赖 de.robv（libxposed 环境下没有该 API），
 * 统一走模块自己的 HookEngine，legacy / modern 都能用。
 */
object XpHooks {

    fun clazz(cl: ClassLoader, name: String): Class<*>? =
        runCatching { Class.forName(name, false, cl) }.getOrNull()

    fun methods(cl: ClassLoader, className: String, method: String, maxParams: Int = 99): List<java.lang.reflect.Method> {
        val c = clazz(cl, className) ?: return emptyList()
        return c.declaredMethods.filter { it.name == method && it.parameterCount <= maxParams }
    }

    /** 命中后直接让方法返回固定值 */
    fun hookResult(cl: ClassLoader, className: String, method: String, value: Any?, maxParams: Int = 99): Boolean {
        val list = methods(cl, className, method, maxParams)
        if (list.isEmpty()) return false
        list.forEach { m ->
            runCatching {
                m.isAccessible = true
                HookEngineManager.engine.hookBefore(m) { p -> p.result = value }
            }
        }
        return true
    }

    /** 等第一个 Activity.onResume 之后再执行安装，避免启动期类未初始化 */
    fun installOnResume(cl: ClassLoader, block: () -> Unit) {
        val act = clazz(cl, "android.app.Activity") ?: return
        var done = false
        act.declaredMethods.filter { it.name == "onResume" && it.parameterCount == 0 }.forEach { m ->
            runCatching {
                HookEngineManager.engine.hookAfter(m) {
                    if (done) return@hookAfter
                    done = true
                    runCatching { block() }
                }
            }
        }
    }

    /** 命中后让方法什么都不做（void 方法） */
    fun hookVoid(cl: ClassLoader, className: String, method: String, maxParams: Int = 99): Boolean {
        val list = methods(cl, className, method, maxParams)
        if (list.isEmpty()) return false
        list.forEach { m ->
            runCatching {
                m.isAccessible = true
                HookEngineManager.engine.hookBefore(m) { p -> p.result = null }
            }
        }
        return true
    }
}
