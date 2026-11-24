package luo.qlsu.autodaily.hook.utils

import com.tencent.mobileqq.qroute.QRoute
import luo.qlsu.autodaily.hook.base.loadAs
import luo.qlsu.autodaily.utils.invokeAs

object NtUidUtil {
    private val relationNTUinAndUidApi by lazy {
        QRoute.api(loadAs("com.tencent.relation.common.api.IRelationNTUinAndUidApi"))
    }

    @JvmStatic
    fun getUidFromUin(uin: String): String {
        return relationNTUinAndUidApi.invokeAs("getUidFromUin", uin)!!
    }

    @JvmStatic
    fun getUinFromUid(uid: String): String {
        return relationNTUinAndUidApi.invokeAs("getUinFromUid", uid)!!
    }
}