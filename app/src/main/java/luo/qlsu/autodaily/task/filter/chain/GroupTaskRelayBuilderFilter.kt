package luo.qlsu.autodaily.task.filter.chain

import luo.qlsu.autodaily.task.filter.FilterChain
import luo.qlsu.autodaily.task.filter.GroupTaskFilter
import luo.qlsu.autodaily.task.filter.GroupTaskFilterChain
import luo.qlsu.autodaily.task.model.Task

class GroupTaskRelayBuilderFilter: GroupTaskFilter(
    TAG = "GroupTaskRelayBuilderFilter"
) {

    override fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>,
        chain: FilterChain
    ) {
        val taskGroup = (chain as GroupTaskFilterChain).taskGroup
        taskGroup.preTasks.forEach {
            if (it.cron == null) {
                relayTaskMap[it.id] = it
            }
        }
        chain.doFilter(relayTaskMap, taskList, env)
    }
}