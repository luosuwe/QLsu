package luo.qlsu.autodaily.task.cron.listener

import luo.qlsu.autodaily.task.cron.TaskExecutor

open class SimpleTaskListener: TaskListener {

    override fun onStart(executor: TaskExecutor) {}

    override fun onSucceeded(executor: TaskExecutor) {}

    override fun onFailed(executor: TaskExecutor, exception: Throwable) {}
}