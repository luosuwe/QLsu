package luo.qlsu.hook.api

import com.tencent.mobileqq.troop.onlinepush.api.impl.TroopOnlinePushHandler
import com.tencent.qqnt.troopmemberlist.ITroopMemberListRepoApi
import kotlinx.coroutines.suspendCancellableCoroutine
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.common.ModuleScope
import luo.qlsu.hook.base.BaseApiHookItem
import luo.qlsu.hook.base.Listener
import luo.qlsu.utils.dexkit.DexKitTask
import luo.qlsu.utils.hook.getFirstArg
import luo.qlsu.utils.hook.hookAfter
import luo.qlsu.utils.json.ProtoData
import luo.qlsu.utils.json.str
import luo.qlsu.utils.json.walk
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.qq.api
import luo.qlsu.utils.reflect.findMethod
import luo.qlsu.utils.reflect.toClass
import org.luckypray.dexkit.query.FindMethod
import org.luckypray.dexkit.query.base.BaseMatcher
import kotlin.coroutines.resume

@HookItemAnnotation("监听用户入群")
object OnTroopJoin : BaseApiHookItem<TroopJoinListener>(), DexKitTask {
    override fun loadHook() {

        if (HostInfo.isTIM) {
            requireMethod("handleJoin").hookAfter(this) { param ->
                handleJoin(
                    param.args[0] as String, param.args[1] as String
                )
            }
        }

        if (HostInfo.isQQ) {
            "com.tencent.qqnt.push.processor.TroopMemberAddPushProcessor".toClass.findMethod {
                returnType = void
                paramTypes(arrayList)
            }.hookAfter(this) { param ->
                val byteList = param.getFirstArg<ArrayList<Byte>>()
                val json = ProtoData().apply {
                    fromBytes(byteList?.toByteArray() ?: byteArrayOf())
                }.toJSON()
                val troopUin = json.walk("3", "2", "1").toString()
                val memberUid = json.walk("3", "2", "3").str ?: return@hookAfter

                ModuleScope.launchIO(name) {
                    var uin = ""
                    repeat(10) {
                        uin = getUinFromUid(memberUid)
                        if (uin.isNotEmpty()) return@repeat
                    }
                    handleJoin(troopUin, uin)
                }

            }
        }


    }

    private fun handleJoin(troopUin: String, memberUin: String) {
        forEachChecked { it.onJoin(troopUin, memberUin) }
    }

    private suspend fun getUinFromUid(uid: String): String =
        suspendCancellableCoroutine { continuation ->
            api<ITroopMemberListRepoApi>().fetchTroopMemberUin(uid) { b, s ->
                continuation.resume(if (b) s else "")
            }
        }


    override fun getQueryMap(): Map<String, BaseMatcher> {
        val clazz = String::class.java
        return mapOf(
            "handleJoin" to FindMethod().apply {
                matcher {
                    declaredClass(TroopOnlinePushHandler::class.java)
                    returnType(Void.TYPE)
                    paramTypes(clazz, clazz, clazz)
                    usingStrings("handleMemberAdd addMemberUin:")
                }
            })
    }
}

fun interface TroopJoinListener : Listener {
    fun onJoin(troopUin: String, memberUin: String)
}