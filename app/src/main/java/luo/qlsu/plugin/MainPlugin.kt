package luo.qlsu.plugin

import luo.qlsu.plugin.loader.PluginManager

object MainPlugin {
    fun initAllPluginForCurrent() {
        PluginManager.stopAllPlugins()
        PluginManager.plugins.clear()
        PluginManager.loadAll()
        PluginManager.autoStart()
    }

}