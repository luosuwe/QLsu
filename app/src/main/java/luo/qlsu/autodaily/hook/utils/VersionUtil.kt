package luo.qlsu.autodaily.hook.utils

import luo.qlsu.autodaily.hook.base.hostContext
import luo.qlsu.autodaily.hook.base.hostPackageName
import luo.qlsu.autodaily.hook.base.hostVersionName
import luo.qlsu.autodaily.hook.enums.QQTypeEnum
import luo.qlsu.autodaily.utils.fieldValueAs

object VersionUtil {
    val qqVersionName: String = hostVersionName

    val qqBuildNum: String = QApplicationUtil.application.fieldValueAs("buildNum")!!

    val qqVersionInfo: String = "$qqVersionName,3,$qqBuildNum"

    val qua: String = "V1_AND_SQ_${qqVersionName}_${qqBuildNum}_YYB_D"

    val quaVersion = buildString {
        val type = QQTypeEnum.valueOfPackage(hostPackageName)
        if (type == QQTypeEnum.TIM) {
            append("TIM")
            append("/$qqVersionName.$qqBuildNum")
        } else if (type == QQTypeEnum.QQ) {
            append("QQ")
            append("/$qqVersionName.$qqBuildNum")
        } else {
            append("QQ/8.9.15.9425")
        }
    }
}