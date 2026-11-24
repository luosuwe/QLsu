package luo.qlsu.hook.social

import android.util.Log
import com.tencent.mobileqq.app.CardHandler
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.hook.hookBefore
import luo.qlsu.utils.qq.QQCurrentEnv

/**
 * 点赞诊断：QQ 的方法名被混淆过，所以不再按名字过滤，而是记录 CardHandler
 * 里所有 void、3~7 个参数的方法清单与实际调用，写入 like_diag.txt。
 */
@HookItemAnnotation(
    "点赞诊断",
    "记录 QQ 点赞相关方法调用（排障用，默认开启）",
    HookCategory.SOCIAL
)
object LikeDiagnostics : BaseSwitchHookItem(defaultEnable = true) {

    private const val TAG = "QLsuLikeDiag"

    fun appendDiag(msg: String) {
        Log.i(TAG, msg)
        runCatching {
            val dir = java.io.File(QQCurrentEnv.currentDir)
            if (!dir.exists()) dir.mkdirs()
            java.io.File(dir, "like_diag.txt").appendText(msg + "\n")
        }
    }

    private fun log(msg: String) = appendDiag(msg)

    override fun onInit(): Boolean {
        val all = runCatching { CardHandler::class.java.declaredMethods }.getOrDefault(emptyArray())
        val methods = all.filter {
            it.returnType == Void.TYPE && it.parameterTypes.size in 3..7 && !it.isSynthetic
        }

        log("CardHandler total=${all.size}, candidates=${methods.size}")
        methods.forEach { m ->
            log(
                "method " + m.name + m.parameterTypes.joinToString(prefix = "(", postfix = ")") {
                    it.simpleName
                }
            )
            runCatching {
                m.hookBefore(this) { p ->
                    val args = p.args?.joinToString { a ->
                        when (a) {
                            is ByteArray -> "bytes(${a.size})"
                            else -> a.toString()
                        }
                    } ?: "null"
                    log("CALL ${m.name} args=$args")
                }
                m.hookAfter(this) { p -> log("RET ${m.name} -> ${p.result}") }
            }
        }
        return methods.isNotEmpty()
    }
}
