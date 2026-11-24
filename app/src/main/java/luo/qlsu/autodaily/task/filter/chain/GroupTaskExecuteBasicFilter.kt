package luo.qlsu.autodaily.task.filter.chain

import luo.qlsu.autodaily.task.filter.FilterChain
import luo.qlsu.autodaily.task.filter.GroupTaskFilter
import luo.qlsu.autodaily.task.filter.GroupTaskFilterChain
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.request.enum.ReqType
import luo.qlsu.autodaily.task.util.TaskUtil
import luo.qlsu.autodaily.utils.LogUtil

class GroupTaskExecuteBasicFilter: GroupTaskFilter(
    TAG = "GroupTaskExecuteBasicFilter"
) {
    override fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>,
        chain: FilterChain
    ) {
        val groupTask = (chain as GroupTaskFilterChain).taskGroup
        val type = ReqType.getType(groupTask.type.split("|")[0])
        groupTask.preTasks.forEach {
            if (it.cron == "basic") {
                try {
                    executeBasicTask(type, it, relayTaskMap, env)
                } catch (e: Throwable) {
                    LogUtil.e(e, "执行basic任务失败，跳过本次执行")
                    return
                }
            }
        }
        chain.doFilter(relayTaskMap, taskList, env)
    }

    private fun executeBasicTask(reqType: ReqType, task: Task, relayTaskMap: Map<String, Task>, env: MutableMap<String, Any>) {
        LogUtil.d("执行basic请求：${task.id}")
        TaskUtil.execute(reqType, task, relayTaskMap, env)
    }
}