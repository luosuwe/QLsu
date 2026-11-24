package luo.qlsu.autodaily.hook

import com.tencent.qphone.base.remote.FromServiceMsg
import com.tencent.qphone.base.remote.ToServiceMsg
import luo.qlsu.autodaily.hook.base.load
import luo.qlsu.autodaily.hook.inject.BaseServlet
import luo.qlsu.autodaily.hook.utils.ServiceMsgParseUtil
import luo.qlsu.autodaily.task.model.VoterInfo
import luo.qlsu.autodaily.utils.LogUtil
import luo.qlsu.autodaily.utils.fieldValue
import luo.qlsu.autodaily.utils.invoke
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.hook.hookReplace

/**
 * 把 XAutoDaily 的三个「MSF 层」钩子合到 QLsu 的 Hook 引擎上：
 *  - receiveMessageFromMSF：把回包按 appSeq 投递给本模块注册的 Servlet，并解析小程序 code/profile 等；
 *  - sendMessageToMSF：原版直接吞掉（不让宿主再处理一次）；
 *  - ToServiceMsg.setTimeout：保住 9999 这个自定义标记。
 */
object FromServiceMsgHook {

    /** MiniLoginManager / MiniProfileManager 等靠这里拿异步回包。 */
    val resMap = HashMap<String, Any?>(5)

    private const val MARK_TIMEOUT = 9999L

    /**
     * 原版把 MainService.sendMessageToMSF 整个替换成空实现。
     * 合并进 QLsu 后如果这个方法是通用发送路径，会直接掐断 QQ 的正常网络请求，
     * 所以默认不接管；只有确认签到 Servlet 出现「重复发送」时才把它改回 true。
     */
    private const val HOOK_SEND_TO_MSF = false

    fun install() {
        installReceiveHook()
        if (HOOK_SEND_TO_MSF) {
            installSendHook()
        }
        installTimeoutHook()
    }

    private fun installReceiveHook() {
        val mainService = runCatching { load("mqq.app.MainService") }.getOrNull() ?: return
        val receiveMethods = mainService.declaredMethods.filter { it.name == "receiveMessageFromMSF" }
        if (receiveMethods.isEmpty()) {
            LogUtil.w("MainService.receiveMessageFromMSF 未找到，MSF 回包将只依赖框架默认分发")
        }
        receiveMethods.forEach { method ->
            runCatching {
                method.hookAfter { param ->
                    runCatching {
                        val args = param.args
                        val to = args.filterIsInstance<ToServiceMsg>().firstOrNull()
                        val from = args.filterIsInstance<FromServiceMsg>().firstOrNull() ?: return@hookAfter
                        // 先按 appSeq 投递给本模块注册的 Servlet（群签到 / 收藏等 OIDB 回包）
                        if (to != null) BaseServlet.dispatch(to, from)
                        onResponse(from)
                    }.onFailure { LogUtil.e(it, "receiveMessageFromMSF hook") }
                }
            }.onFailure { LogUtil.e(it, "hook receiveMessageFromMSF failed") }
        }
    }

    private fun installSendHook() {
        val mainService = runCatching { load("mqq.app.MainService") }.getOrNull() ?: return
        mainService.declaredMethods
            .filter { it.name == "sendMessageToMSF" }
            .forEach { method ->
                runCatching { method.hookReplace { null } }
                    .onFailure { LogUtil.e(it, "hook sendMessageToMSF failed") }
            }
    }

    private fun installTimeoutHook() {
        val toServiceMsg = runCatching { load("com.tencent.qphone.base.remote.ToServiceMsg") }
            .getOrNull() ?: return
        toServiceMsg.declaredMethods
            .filter {
                it.name == "setTimeout" && it.parameterTypes.size == 1 &&
                        it.parameterTypes[0] == java.lang.Long.TYPE
            }
            .forEach { method ->
                runCatching {
                    method.hookReplace { chain ->
                        val self = chain.thisObject as ToServiceMsg
                        if (self.timeout == MARK_TIMEOUT) null else chain.proceed()
                    }
                }.onFailure { LogUtil.e(it, "hook ToServiceMsg.setTimeout failed") }
            }
    }

    /**
     * 只处理 XAutoDaily 业务用到的几类回包，其余原样放行。
     */
    private fun onResponse(fromServiceMsg: FromServiceMsg) {
        when (fromServiceMsg.serviceCmd) {
            "LightAppSvc.mini_program_auth.GetCode" -> {
                val code = ServiceMsgParseUtil.parseLoginCode(fromServiceMsg)
                if (resMap.containsKey("syncGetLoginCode")) {
                    resMap["syncGetLoginCode"] = code
                }
            }

            "LightAppSvc.mini_user_info.GetProfile" -> {
                val res = ServiceMsgParseUtil.parseProfile(fromServiceMsg)
                if (resMap.containsKey("syncGetProfile")) {
                    resMap["syncGetProfile"] = res
                }
            }

            "VisitorSvc.ReqGetVoterList" -> {
                val v = runCatching { fromServiceMsg.invoke("getAttribute", "result") }.getOrNull()
                val list = runCatching { v?.fieldValue("vVoterInfos") as List<*>? }.getOrNull()
                val res = mutableListOf<VoterInfo>()
                runCatching {
                    list?.forEach {
                        if (it == null) return@forEach
                        val lTime = it.fieldValue("lTime") as Int
                        val lEctID = it.fieldValue("lEctID") as Long
                        val bTodayVotedCnt = it.fieldValue("bTodayVotedCnt") as Short
                        val bVoteCnt = it.fieldValue("bVoteCnt") as Short
                        val bAvailableCnt = it.fieldValue("bAvailableCnt") as Short
                        res.add(
                            VoterInfo(
                                lEctID, lTime, bVoteCnt, bTodayVotedCnt, bAvailableCnt
                            )
                        )
                    }
                }
                if (resMap.containsKey("syncGetVoterList")) {
                    resMap["syncGetVoterList"] = res
                }
            }
        }
    }
}
