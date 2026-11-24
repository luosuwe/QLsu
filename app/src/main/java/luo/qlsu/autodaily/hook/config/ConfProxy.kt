package luo.qlsu.autodaily.hook.config

import android.os.Parcelable
import luo.qlsu.autodaily.store.Kv

/**
 * 原版 ConfProxy 包了 MMKV，这里换成 Kv（SharedPreferences）。
 * 方法签名保持完全一致，AutoDaily 的任务/配置代码不需要任何改动。
 */
open class ConfProxy(
    private val kv: Kv?
) {

    open fun getKeys(): Array<String> {
        return kv?.allKeys() ?: emptyArray()
    }

    open fun contains(key: String): Boolean {
        return kv?.contains(key) ?: false
    }

    open fun getBoolean(key: String, defaultValue: Boolean): Boolean {
        return kv?.getBoolean(key, defaultValue) ?: defaultValue
    }

    open fun putBoolean(key: String, value: Boolean) {
        kv?.putBoolean(key, value)
    }

    open fun getInt(key: String, defaultValue: Int): Int {
        return kv?.getInt(key, defaultValue) ?: defaultValue
    }

    open fun putInt(key: String, value: Int) {
        kv?.putInt(key, value)
    }

    open fun getLong(key: String, defaultValue: Long): Long {
        return kv?.getLong(key, defaultValue) ?: defaultValue
    }

    open fun putLong(key: String, value: Long) {
        kv?.putLong(key, value)
    }

    open fun getFloat(key: String, defaultValue: Float): Float {
        return kv?.getFloat(key, defaultValue) ?: defaultValue
    }

    open fun putFloat(key: String, value: Float) {
        kv?.putFloat(key, value)
    }

    open fun getString(key: String): String? {
        return kv?.getString(key)
    }

    open fun getString(key: String, defaultValue: String): String {
        return getString(key) ?: defaultValue
    }

    open fun putString(key: String, value: String? = null) {
        kv?.putString(key, value)
    }

    open fun getStringSet(key: String): Set<String>? {
        return kv?.getStringSet(key)
    }

    open fun getStringSet(key: String, defaultValue: Set<String>): Set<String> {
        return getStringSet(key) ?: defaultValue
    }

    open fun putStringSet(key: String, value: Set<String>? = null) {
        kv?.putStringSet(key, value)
    }

    open fun <T : Parcelable> getParcelable(key: String, clazz: Class<T>): T? = null

    open fun <T : Parcelable> getParcelable(key: String, clazz: Class<T>, defaultValue: T): T {
        return getParcelable(key, clazz) ?: defaultValue
    }

    open fun <T : Parcelable> putParcelable(key: String, value: T?) = Unit

    open fun remove(key: String) {
        kv?.removeValueForKey(key)
    }

    open fun remove(vararg keys: String) {
        kv?.removeValuesForKeys(arrayOf(*keys))
    }

    open fun remove(keys: Collection<String>) {
        kv?.removeValuesForKeys(Array(keys.size) { keys.elementAt(it) })
    }

    open fun removeFromKey(prefix: String = "", contains: String = "", suffix: String = "") {
        val removeKeys = mutableSetOf<String>()
        kv?.all()?.keys?.forEach { key ->
            val matched = (prefix.isNotEmpty() && key.startsWith(prefix)) ||
                    (suffix.isNotEmpty() && key.endsWith(suffix)) ||
                    (contains.isNotEmpty() && key.contains(contains))
            if (matched) removeKeys.add(key)
        }
        remove(removeKeys)
    }

    open fun clearAll() {
        kv?.clearAll()
    }
}
