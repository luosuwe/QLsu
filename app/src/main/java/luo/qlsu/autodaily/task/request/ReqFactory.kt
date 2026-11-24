package luo.qlsu.autodaily.task.request

import luo.qlsu.autodaily.task.request.enum.ReqType
import luo.qlsu.autodaily.task.request.impl.FuncTaskReqUtil
import luo.qlsu.autodaily.task.request.impl.HttpTaskReqUtil

object ReqFactory {

    fun getReq(reqType: ReqType): ITaskReqUtil {
        return when(reqType) {
            ReqType.HTTP -> HttpTaskReqUtil
            ReqType.XA_FUNC -> FuncTaskReqUtil
        }
    }
}