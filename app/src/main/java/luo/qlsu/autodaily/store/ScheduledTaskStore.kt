package luo.qlsu.autodaily.store

import kotlinx.serialization.Serializable
import kotlinx.serialization.builtins.ListSerializer
import kotlinx.serialization.decodeFromString
import kotlinx.serialization.encodeToString
import kotlinx.serialization.json.Json
import luo.qlsu.autodaily.hook.config.Config.accountConfig
import luo.qlsu.autodaily.utils.LogUtil

/**
 * 用户在「定时任务」页面手动添加的任务。
 * 只有出现在这个列表里、且 enabled = true 的任务，调度器才会执行。
 */
@Serializable
data class ScheduledTask(
    val id: String,
    val cron: String = "",
    val enabled: Boolean = true,
    val createdAt: Long = 0,
    val lastRunAt: Long = 0L
)

object ScheduledTaskStore {

    private const val KEY = "ad_scheduled_tasks"

    private val json = Json {
        ignoreUnknownKeys = true
        encodeDefaults = true
    }
    private val serializer = ListSerializer(ScheduledTask.serializer())

    fun list(): List<ScheduledTask> = runCatching {
        val raw = accountConfig.getString(KEY)
        if (raw.isNullOrBlank()) emptyList() else json.decodeFromString(serializer, raw)
    }.getOrElse {
        LogUtil.e(it, "读取定时任务列表失败")
        emptyList()
    }

    fun save(list: List<ScheduledTask>) {
        accountConfig.putString(KEY, json.encodeToString(serializer, list))
    }

    fun add(id: String, cron: String): Boolean {
        val current = list()
        if (current.any { it.id == id }) return false
        save(current + ScheduledTask(id = id, cron = cron, enabled = true, createdAt = System.currentTimeMillis()))
        return true
    }

    fun remove(id: String) {
        save(list().filterNot { it.id == id })
    }

    fun markRun(id: String, time: Long) {
        val list = list().toMutableList()
        val i = list.indexOfFirst { it.id == id }
        if (i >= 0) {
            list[i] = list[i].copy(lastRunAt = time)
            save(list)
        }
    }

    fun setEnabled(id: String, enabled: Boolean) {
        val now = System.currentTimeMillis()
        save(list().map {
            if (it.id != id) it
            else if (enabled) it.copy(enabled = true, createdAt = now, lastRunAt = 0)
            else it.copy(enabled = false)
        })
    }

    fun setCron(id: String, cron: String) {
        val now = System.currentTimeMillis()
        save(list().map {
            if (it.id == id) it.copy(cron = cron, createdAt = now, lastRunAt = 0) else it
        })
    }

    fun find(id: String): ScheduledTask? = list().firstOrNull { it.id == id }

    fun isEnabled(id: String): Boolean = find(id)?.enabled == true

    fun cronOf(id: String): String = find(id)?.cron.orEmpty()

    fun ids(): Set<String> = list().map { it.id }.toSet()
}
