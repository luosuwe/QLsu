package luo.qlsu.autodaily.hook.function.proxy

import luo.qlsu.autodaily.hook.function.BaseSendMessage
import luo.qlsu.autodaily.hook.function.base.BaseFunction
import luo.qlsu.autodaily.hook.function.impl.FavoriteManager
import luo.qlsu.autodaily.hook.function.impl.FriendsManager
import luo.qlsu.autodaily.hook.function.impl.GroupSignInManager
import luo.qlsu.autodaily.hook.function.impl.GuildManager
import luo.qlsu.autodaily.hook.function.impl.MiniLoginManager
import luo.qlsu.autodaily.hook.function.impl.MiniProfileManager
import luo.qlsu.autodaily.hook.function.impl.NtSendMessageManager
import luo.qlsu.autodaily.hook.function.impl.PublicAccountManager
import luo.qlsu.autodaily.hook.function.impl.QZIntimateSpaceManager
import luo.qlsu.autodaily.hook.function.impl.SendMessageManager
import luo.qlsu.autodaily.hook.function.impl.TicketManager
import luo.qlsu.autodaily.hook.function.impl.TroopManager
import luo.qlsu.autodaily.hook.function.impl.YunDongStepsManager
import luo.qlsu.autodaily.hook.utils.QApplicationUtil
import luo.qlsu.autodaily.utils.LogUtil

/**
 * 原版用 ByteBuddy 给每个 BaseFunction 生成子类，靠拦截器保证「init 成功才执行」。
 * QLsu 里不再引入 byte-buddy（少一个运行时 dex 生成环节），改成创建时立即 init：
 * 初始化失败的功能会在日志里留下记录，任务执行时自然失败并被 TaskUtil 捕获。
 */
object FunctionPool {

    private val functionMap = HashMap<Class<out BaseFunction>, BaseFunction>()

    @Synchronized
    fun <T : BaseFunction> getFunction(functionClass: Class<T>): T {
        @Suppress("UNCHECKED_CAST")
        functionMap[functionClass]?.let { return it as T }
        val instance = functionClass.getDeclaredConstructor().newInstance()
        val ok = runCatching { instance.isInit }.getOrElse {
            LogUtil.e(it, "function [${instance.TAG}] init error")
            false
        }
        if (!ok) {
            LogUtil.w("function [${instance.TAG}] 初始化失败，相关任务将不可用")
        }
        functionMap[functionClass] = instance
        return instance
    }

    val favoriteManager by lazy { getFunction(FavoriteManager::class.java) }

    val ticketManager by lazy { getFunction(TicketManager::class.java) }

    val friendsManager by lazy { getFunction(FriendsManager::class.java) }

    val troopManager by lazy { getFunction(TroopManager::class.java) }

    val guildManager by lazy { getFunction(GuildManager::class.java) }

    val miniLoginManager by lazy { getFunction(MiniLoginManager::class.java) }

    val sendMessageManager: BaseSendMessage by lazy {
        if (runCatching { QApplicationUtil.isNtQQ() }.getOrDefault(false)) {
            getFunction(NtSendMessageManager::class.java)
        } else {
            getFunction(SendMessageManager::class.java)
        }
    }

    val groupSignInManager by lazy { getFunction(GroupSignInManager::class.java) }

    val miniProfileManager by lazy { getFunction(MiniProfileManager::class.java) }

    val publicAccountManager by lazy { getFunction(PublicAccountManager::class.java) }

    val yunDongStepsManager by lazy { getFunction(YunDongStepsManager::class.java) }

    val qzIntimateSpaceManager by lazy { getFunction(QZIntimateSpaceManager::class.java) }

    /** 预热全部功能（首次进任务前调用，避免第一条任务把时间耗在初始化上）。 */
    fun warmUp() {
        runCatching {
            ticketManager
            friendsManager
            troopManager
            sendMessageManager
            miniLoginManager
            miniProfileManager
            publicAccountManager
            groupSignInManager
            yunDongStepsManager
            guildManager
            favoriteManager
            qzIntimateSpaceManager
        }.onFailure { LogUtil.e(it, "FunctionPool warmUp") }
    }
}
