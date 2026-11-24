package luo.qlsu.autodaily.task.filter

import luo.qlsu.autodaily.hook.notification.XANotification
import luo.qlsu.autodaily.task.exception.TaskTimeoutException
import luo.qlsu.autodaily.task.filter.chain.GroupTaskCheckExecuteFilter
import luo.qlsu.autodaily.task.filter.chain.GroupTaskExecuteBasicFilter
import luo.qlsu.autodaily.task.filter.chain.GroupTaskPreFilter
import luo.qlsu.autodaily.task.filter.chain.GroupTaskRelayBuilderFilter
import luo.qlsu.autodaily.task.model.Task
import luo.qlsu.autodaily.task.model.TaskGroup
import luo.qlsu.autodaily.task.request.enum.ReqType
import luo.qlsu.autodaily.task.util.TaskUtil
import luo.qlsu.autodaily.task.util.formatDate
import luo.qlsu.autodaily.ui.ConfUnit
import luo.qlsu.autodaily.ui.errInfo
import luo.qlsu.autodaily.utils.LogUtil
import luo.qlsu.autodaily.utils.TimeUtil
import java.io.InterruptedIOException
import java.net.ConnectException
import java.net.SocketException
import java.net.SocketTimeoutException
import java.net.UnknownHostException
import java.util.Date
import javax.net.ssl.SSLHandshakeException

class GroupTaskFilterChain(
    val taskGroup: TaskGroup
) : FilterChain {

    private var pos = 0
    private val filters: MutableList<GroupTaskFilter> = ArrayList()

    companion object {
        fun build(taskGroup: TaskGroup): FilterChain {
            val chain = GroupTaskFilterChain(taskGroup)
            chain.add(GroupTaskCheckExecuteFilter())
            chain.add(GroupTaskPreFilter())
            chain.add(GroupTaskRelayBuilderFilter())
            chain.add(GroupTaskExecuteBasicFilter())
            return chain
        }
    }

    fun add(groupTaskFilter: GroupTaskFilter) {
        filters.add(groupTaskFilter)
    }

    override fun doFilter(
        relayTaskMap: MutableMap<String, Task>,
        taskList: MutableList<Task>,
        env: MutableMap<String, Any>
    ) {
        if (pos < filters.size) {
            val filter = filters[pos++]
            LogUtil.d("当前filter -> ${filter.TAG}")
            filter.doFilter(relayTaskMap, taskList, env, this)
        } else {
            val reqType = ReqType.getType(taskGroup.type.split("|").first())
            for (task in taskList) {
                val taskException = task.errInfo
                if (taskException.count >= 3) {
                    LogUtil.i("任务${task.id}执行错误次数超过3次，本次启动暂停执行")
                    continue
                }
                try {
                    XANotification.setContent("正在执行任务${task.id}")
                    TaskUtil.execute(reqType, task, relayTaskMap, env)
                } catch (e: Throwable) {
                    when (e) {
                        is ConnectException,
                        is SocketException,
                        is SocketTimeoutException,
                        is UnknownHostException,
                        is InterruptedIOException,
                        is SSLHandshakeException,
                        is TaskTimeoutException -> {
                            LogUtil.e(e, "执行任务 ${task.id} 出现网络异常，等待重试: ")
                        }
                        else -> {
                            LogUtil.e(e, "执行任务 ${task.id} 异常: ")
                            taskException.count++
                            taskException.dateStr = Date(TimeUtil.localTimeMillis()).formatDate()
                            task.errInfo = taskException
                            if (taskException.count >= 3 && ConfUnit.enableTaskExceptionNotification) {
                                XANotification.notify("任务${task.id}执行异常，本次启动跳过执行")
                            }
                        }
                    }
                }
            }
        }
    }
}