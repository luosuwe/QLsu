package luo.qlsu.autodaily.task.filter.chain

import luo.qlsu.autodaily.task.filter.FilterChain
import luo.qlsu.autodaily.task.filter.GroupTaskFilter
import luo.qlsu.autodaily.task.filter.GroupTaskFilterChain
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.utils.LogUtil

class GroupTaskPreFilter : GroupTaskFilter(
    TAG = "GroupTaskPreFilter"
) {

    override fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>,
        chain: FilterChain
    ) {
        val groupTask = (chain as GroupTaskFilterChain).taskGroup
        val arr = groupTask.type.split("|")
        if (arr[0] == "mini") {
            env["mini_app_id"] = arr[1]
        }
        LogUtil.d("groupTask -> ${groupTask.id} 任务类型为: ${arr[0]}")
        chain.doFilter(relayTaskMap, taskList, env)
    }
}