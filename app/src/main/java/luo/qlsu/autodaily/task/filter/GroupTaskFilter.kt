package luo.qlsu.autodaily.task.filter

import luo.qlsu.autodaily.task.model.Task

abstract class GroupTaskFilter(
    val TAG: String
) {

    abstract fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>,
        chain: FilterChain
    )
}