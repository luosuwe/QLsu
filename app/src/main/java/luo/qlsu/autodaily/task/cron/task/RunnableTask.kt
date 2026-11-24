package luo.qlsu.autodaily.task.cron.task

/**
 * [Runnable] 的 [Task]包装
 * @author Looly
 */
class RunnableTask(private val runnable: Runnable) : Task {
    override fun execute() {
        runnable.run()
    }
}
