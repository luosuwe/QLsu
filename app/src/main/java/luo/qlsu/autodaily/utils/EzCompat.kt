package luo.qlsu.autodaily.utils

import org.json.JSONArray
import org.json.JSONObject
import java.lang.reflect.Method
import java.lang.reflect.Modifier

/**
 * 原版 XAutoDaily 在几个 Manager 里用了 EzXHelper 的几个纯反射工具函数。
 * QLsu 不引入 EzXHelper（避免再挂一个 Xposed 生态依赖），这里给出等价实现，
 * 方法名/参数名保持一致，调用点无需改动。
 */

val Method.isPublic: Boolean
    get() = Modifier.isPublic(modifiers)

val Method.paramCount: Int
    get() = parameterTypes.size

fun argTypes(vararg types: Class<*>): Array<Class<*>> = arrayOf(*types)

fun Any.method(name: String, argTypes: Array<Class<*>>): Method =
    this.getMethods(true).first {
        it.name == name && it.parameterTypes.contentEquals(argTypes)
    }

fun buildJSONObject(block: JSONObject.() -> Unit): JSONObject = JSONObject().apply(block)

fun buildJSONArray(block: JSONArray.() -> Unit): JSONArray = JSONArray().apply(block)
