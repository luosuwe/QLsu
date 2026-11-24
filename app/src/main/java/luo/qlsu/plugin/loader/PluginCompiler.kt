package luo.qlsu.plugin.loader

import bsh.BshMethod
import bsh.Interpreter
import luo.qlsu.hook.api.MenuClickListener
import luo.qlsu.hook.api.OnMenuBuild
import luo.qlsu.hook.api.OnPaiYiPai
import luo.qlsu.hook.api.OnReceiveMsg
import luo.qlsu.hook.api.OnSendMsg
import luo.qlsu.hook.api.OnTroopJoin
import luo.qlsu.hook.api.OnTroopQuit
import luo.qlsu.hook.api.OnTroopShutUp
import luo.qlsu.lifecycle.DynamicActivityRegistry
import luo.qlsu.plugin.api.PluginCallback
import luo.qlsu.plugin.api.PluginMethod
import luo.qlsu.plugin.bean.MsgData
import luo.qlsu.plugin.bean.PluginInfo
import luo.qlsu.utils.log.PluginError
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.qq.QQCurrentEnv
import luo.qlsu.utils.reflect.ClassUtils
import java.io.File
import java.lang.reflect.Modifier

class PluginCompiler(val info: PluginInfo) {
    var interpreter = Interpreter()
    val menuItems = linkedMapOf<String, String>()
    val msgMenuItem = mutableSetOf<String>()
    val registedActivitys = mutableSetOf<String>()

    private val api = PluginMethod(this)
    val callback = PluginCallback(this)
    val loader = FixClassLoader()

    @Synchronized
    fun start() {
        if (info.isRunning) {
            stop(false)
        }

        info.updateFromDisk()

        val scriptFile = File(info.dirPath, "main.java")
        if (!scriptFile.exists()) throw IllegalStateException("main.java not found")

        try {
            interpreter = Interpreter()

            interpreter.apply {
                set("context", HostInfo.hostContext)
                set("myUin", QQCurrentEnv.currentUin)
                set("classLoader", ClassUtils.hostClassLoader)
                set("pluginPath", info.dirPath)
                set("pluginId", info.id)
                setClassLoader(loader)

                PluginMethod::class.java.declaredMethods
                    .filter { Modifier.isPublic(it.modifiers) }
                    .filterNot { it.name.contains("$") }
                    .forEach { nameSpace.setMethod(BshMethod(it, api)) }

                source(scriptFile.absolutePath)
            }
            registerCallbacks()
            info.isRunning = true
        } catch (e: Exception) {
            stop(false)
            throw e
        }
    }

    @Synchronized
    fun stop(invokeCallback: Boolean = true) {
        if (!info.isRunning) return

        if (invokeCallback) {
            try {
                callback.unLoadPlugin()
            } catch (e: Exception) {
                PluginError.callError(e, info)
            }
        }

        try {
            registedActivitys.forEach {
                DynamicActivityRegistry.unregister(it)
            }
            removeCallbacks()
            interpreter.nameSpace.clear()
            menuItems.clear()
            msgMenuItem.clear()
            registedActivitys.clear()
        } catch (e: Exception) {
            PluginError.callError(e, info)
        } finally {
            info.isRunning = false
        }
    }

    private fun registerCallbacks() {
        OnReceiveMsg.addListener(callback.receiveMsgListener)
        OnSendMsg.addListener(callback.sendMsgListener)
        OnTroopJoin.addListener(callback.troopJoinListener)
        OnTroopQuit.addListener(callback.troopQuitListener)
        OnTroopShutUp.addListener(callback.troopShutUpListener)
        OnPaiYiPai.addListener(callback.paiYiPaiListener)
        msgMenuItem.forEach { item ->
            val args = item.split(",")
            if (args.size >= 4) {
                OnMenuBuild.addListener(object : MenuClickListener {
                    override val menuKey: String get() = item
                    override fun onClick(msgData: MsgData) {
                        callback.invokeMsgMenuItem(args[3], msgData)
                    }
                })
            }
        }
    }

    private fun removeCallbacks() {
        OnReceiveMsg.removeListener(callback.receiveMsgListener)
        OnSendMsg.removeListener(callback.sendMsgListener)
        OnTroopJoin.removeListener(callback.troopJoinListener)
        OnTroopQuit.removeListener(callback.troopQuitListener)
        OnTroopShutUp.removeListener(callback.troopShutUpListener)
        OnPaiYiPai.removeListener(callback.paiYiPaiListener)
        msgMenuItem.forEach { item ->
            OnMenuBuild.listenerSet.removeIf { it.menuKey == item }
        }
    }
}