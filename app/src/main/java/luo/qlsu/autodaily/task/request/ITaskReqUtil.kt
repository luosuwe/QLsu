package luo.qlsu.autodaily.task.request

import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.request.model.TaskRequest
import luo.qlsu.autodaily.task.request.model.TaskResponse

interface ITaskReqUtil {

    fun create(
        task: Task,
        env: MutableMap<String, Any>
    ): List<TaskRequest>

    fun executor(
        taskRequest: TaskRequest
    ): TaskResponse
}