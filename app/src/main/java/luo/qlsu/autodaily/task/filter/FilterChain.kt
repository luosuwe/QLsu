package luo.qlsu.autodaily.task.filter

import luo.qlsu.autodaily.task.model.Task


interface FilterChain {

    fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>
    )
}