package luo.qlsu.autodaily.task.filter.chain

import luo.qlsu.autodaily.task.filter.FilterChain
import luo.qlsu.autodaily.task.filter.GroupTaskFilter
import luo.qlsu.autodaily.task.filter.GroupTaskFilterChain
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.util.ConfigUtil
import luo.qlsu.autodaily.ui.errInfo
import luo.qlsu.autodaily.utils.LogUtil

class GroupTaskCheckExecuteFilter : GroupTaskFilter(
    TAG = "GroupTaskCheckExecuteFilter"
) {

    override fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>,
        chain: FilterChain
    ) {
        val taskGroup = (chain as GroupTaskFilterChain).taskGroup
        taskGroup.tasks.forEach {
            if (ConfigUtil.checkExecuteTask(it) && it.errInfo.count < 3) {
                LogUtil.d("task -> ${it.id} 将被执行")
                taskList.add(it)
            }
        }
        if (taskList.isEmpty()) {
            // 没有任何任务需要执行
            LogUtil.d("${taskGroup.id}: 没有任何任务需要执行")
            return
        }
        chain.doFilter(relayTaskMap, taskList, env)
    }
}