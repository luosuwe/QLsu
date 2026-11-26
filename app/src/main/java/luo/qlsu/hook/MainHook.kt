package luo.qlsu.hook

import androidx.core.content.edit
import luo.qlsu.account.AccountSync
import luo.qlsu.autodaily.AdEngine
import luo.qlsu.hook.entry.QlsuEntryHook
import luo.qlsu.hook.sign.SignInSync

import luo.qlsu.generated.HookRegistry
import luo.qlsu.hook.base.BaseApiHookItem
import luo.qlsu.hook.base.BaseClickableHookItem
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.hook.base.Listener
import luo.qlsu.hook.compat.QfunCompat
import luo.qlsu.plugin.MainPlugin
import luo.qlsu.ui.pages.configs.ConfigUiRegistry
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.log.LogUtils
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.toClass

object MainHook {

    private var initialized = false
    private val allHookItem = HookRegistry.hookItems
    private val apiHookItemList =
        allHookItem.filterIsInstance<BaseApiHookItem<Listener>>()
    val switchHookItemList =
        allHookItem.filterIsInstance<BaseSwitchHookItem>()
    val clickableHookItemList =
        switchHookItemList.filterIsInstance<BaseClickableHookItem<*>>()


    fun loadHook() {

        // 账号同步：模块激活 / QQ 登录后把 QQ 号上报后端，首次上报自动注册（密码 = QQ 号）
        runCatching { AccountSync.sync() }

        // 签到子系统常驻：不提供总开关，任务是否执行由每个任务的定时开关决定
        runCatching { AdEngine.install() }
        // 把「签到」分类里各开关的状态写进 AutoDaily 的每日调度
        runCatching { SignInSync.applyAll() }
        // 后台被杀了导致错过时间：启动后延迟 20 秒补跑当天未执行的任务
        Thread {
            runCatching { Thread.sleep(20000) }
            runCatching { AdEngine.catchUpMissed() }
        }.start()
        loadApiHook()
        initSwitchHookItem()
        hookAccountChange()


    }

    private fun loadApiHook() = apiHookItemList
        .forEach {
            try {
                // QFun 也 Hook 同一批方法时会互相覆盖，检测到 QFun 就让出重叠功能
                if (QfunCompat.shouldYield(it.name)) {
                    QfunCompat.logYield(it.name)
                    return@forEach
                }
                if (it.isInTargetProcess()) it.loadHook()
            } catch (t: Throwable) {
                LogUtils.e(it, t)
            }
        }

    fun initAllConfigUI() {
        if (initialized) return
        initialized = true

        clickableHookItemList
            .forEach { item ->
                ConfigUiRegistry.register(item.name) { onDismiss ->
                    item.ConfigContent(onDismiss)
                }
            }
    }

    private fun initSwitchHookItem() = switchHookItemList.forEach {
        if (QfunCompat.shouldYield(it.name)) {
            QfunCompat.logYield(it.name)
        } else {
            it.init()
        }
    }

    fun processDataForCurrent(tag: String) = clickableHookItemList
        .filter(BaseSwitchHookItem::isAvailable)
        .forEach {
            when (tag) {
                "init" -> it.initData()
                "save" -> it.saveData()
            }
        }


    private fun hookAccountChange() {

        "com.tencent.imcore.message.BaseQQMessageFacade".toClass
            .declaredConstructors.first()
            .hookAfter {
                QQCurrentEnv.globalPreference.edit {
                    putString(
                        "currentUin",
                        QQCurrentEnv.currentUin
                    )
                }
                // 切号后重新上报，让后端账号与当前 QQ 保持一致
                runCatching { AccountSync.sync(force = true) }
                processDataForCurrent("init")
                MainPlugin.initAllPluginForCurrent()
                runCatching { AdEngine.onAccountChanged() }

            }
    }

}