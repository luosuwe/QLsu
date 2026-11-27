package luo.qlsu.hook.sign

import luo.qlsu.utils.qq.QQCurrentEnv

/**
 * 取宿主 Cookie（参考 QEdge CookieTool 的实现，改走 QLsu 自己的反射工具）。
 * skey / p_skey 都能从 QQ 的 TicketManager 取到。
 */
object TicketTool {

    private fun appRuntime(): Any? = runCatching { QQCurrentEnv.qQAppInterface }.getOrNull()

    private fun manager(): Any? {
        val rt = appRuntime() ?: return null
        runCatching {
            rt.javaClass.methods
                .firstOrNull { it.name == "getManager" && it.parameterTypes.size == 1 && it.parameterTypes[0] == Int::class.javaPrimitiveType }
                ?.invoke(rt, 2)
        }.getOrNull()?.let { return it }
        runCatching {
            val tm = Class.forName("mqq.manager.TicketManager", false, rt.javaClass.classLoader)
            rt.javaClass.methods
                .firstOrNull { it.name == "getRuntimeService" && it.parameterTypes.size == 2 }
                ?.invoke(rt, tm, "")
        }.getOrNull()?.let { return it }
        return null
    }

    private fun call(name: String, vararg args: Any?): String? = runCatching {
        val m = manager() ?: return null
        m.javaClass.methods
            .firstOrNull { it.name == name && it.parameterTypes.size == args.size }
            ?.invoke(m, *args)?.toString()
    }.getOrNull()

    fun skey(): String? = call("getSkey", QQCurrentEnv.currentUin)
    fun pskey(domain: String): String? = call("getPskey", QQCurrentEnv.currentUin, domain)

    fun bkn(key: String): Long {
        var hash = 5381L
        for (c in key) {
            hash += (hash shl 5) + c.code
        }
        return hash and 0x7FFFFFFFL
    }
}
