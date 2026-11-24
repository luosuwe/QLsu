package luo.qlsu.autodaily.hook.function

import luo.qlsu.autodaily.hook.function.base.BaseFunction

abstract class BaseSendMessage(TAG: String): BaseFunction(TAG) {
    abstract fun sendTextMessage(uin: String, msg: String, isGroup: Boolean)
}