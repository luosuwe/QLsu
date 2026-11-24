package luo.qlsu.autodaily.hook.function.impl

import luo.qlsu.autodaily.hook.base.load
import luo.qlsu.autodaily.hook.function.base.BaseFunction
import luo.qlsu.autodaily.hook.utils.QApplicationUtil
import luo.qlsu.autodaily.utils.new
import mqq.app.AppRuntime
import java.lang.reflect.Method

open class QZIntimateSpaceManager : BaseFunction(
    TAG = "QZIntimateSpaceManager"
) {
    lateinit var viewModel: Any
    lateinit var checkInMethod: Method

    override fun init() {
        val viewModelClz = load("Lcom/qzone/reborn/intimate/viewmodel/QZIntimateCheckInViewModel;")!!
        viewModel = viewModelClz.new()
        checkInMethod = viewModelClz.declaredMethods.first { method ->
            val types = method.parameterTypes
            if (types.size != 2) return@first false
            val oldParam = types[0] == String::class.java && types[1] == AppRuntime::class.java // 9.2.30
            val newParam = types[0] == AppRuntime::class.java && types[1] == String::class.java // 9.2.80
            oldParam || newParam
        }.apply { isAccessible = true }
    }

    open fun doCheckInRequest(spaceId: String) {
        checkInMethod.also { m ->
            if (m.parameterTypes[0] == String::class.java) {
                m.invoke(viewModel, spaceId, QApplicationUtil.appRuntime)
            } else {
                m.invoke(viewModel, QApplicationUtil.appRuntime, spaceId)
            }
        }
    }
}
