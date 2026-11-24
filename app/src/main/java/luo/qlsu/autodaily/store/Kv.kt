package luo.qlsu.autodaily.store

import android.content.SharedPreferences

/**
 * 一个 MMKV 风格的键值存储封装，底层用 SharedPreferences(MODE_MULTI_PROCESS)。
 *
 * 原版 XAutoDaily 用 MMKV + 一个带签名校验的 native 库；这里换成系统实现，
 * 好处是不再需要 libxa_native.so / openssl 子模块，也不影响任何任务逻辑。
 */
class Kv(private val prefs: SharedPreferences) {

    fun allKeys(): Array<String> = prefs.all.keys.toTypedArray()

    fun all(): Map<String, *> = prefs.all

    fun contains(key: String): Boolean = prefs.contains(key)

    fun getBoolean(key: String, defaultValue: Boolean): Boolean =
        prefs.getBoolean(key, defaultValue)

    fun putBoolean(key: String, value: Boolean) {
        prefs.edit().putBoolean(key, value).apply()
    }

    fun getInt(key: String, defaultValue: Int): Int = prefs.getInt(key, defaultValue)

    fun putInt(key: String, value: Int) {
        prefs.edit().putInt(key, value).apply()
    }

    fun getLong(key: String, defaultValue: Long): Long = prefs.getLong(key, defaultValue)

    fun putLong(key: String, value: Long) {
        prefs.edit().putLong(key, value).apply()
    }

    fun getFloat(key: String, defaultValue: Float): Float = prefs.getFloat(key, defaultValue)

    fun putFloat(key: String, value: Float) {
        prefs.edit().putFloat(key, value).apply()
    }

    fun getString(key: String): String? = prefs.getString(key, null)

    fun putString(key: String, value: String?) {
        prefs.edit().putString(key, value).apply()
    }

    fun getStringSet(key: String): Set<String>? = prefs.getStringSet(key, null)

    fun putStringSet(key: String, value: Set<String>?) {
        prefs.edit().putStringSet(key, value).apply()
    }

    fun removeValueForKey(key: String) {
        prefs.edit().remove(key).apply()
    }

    fun removeValuesForKeys(keys: Array<String>) {
        val editor = prefs.edit()
        keys.forEach { editor.remove(it) }
        editor.apply()
    }

    fun clearAll() {
        prefs.edit().clear().apply()
    }

    fun trim() = Unit
}
