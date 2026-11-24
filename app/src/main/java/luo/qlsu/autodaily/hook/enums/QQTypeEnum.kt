package luo.qlsu.autodaily.hook.enums

import luo.qlsu.autodaily.config.PACKAGE_NAME_QQ
import luo.qlsu.autodaily.config.PACKAGE_NAME_QQ_INTERNATIONAL
import luo.qlsu.autodaily.config.PACKAGE_NAME_QQ_LITE
import luo.qlsu.autodaily.config.PACKAGE_NAME_TIM

enum class QQTypeEnum(
    val packageName: String,
    val appName: String
) {
    QQ(PACKAGE_NAME_QQ, "QQ"),
    TIM(PACKAGE_NAME_TIM, "TIM"),
    INTERNATIONAL(PACKAGE_NAME_QQ_INTERNATIONAL, "QQ国际版"),
    LITE(PACKAGE_NAME_QQ_LITE, "QQ极速版"),
    ;

    companion object {
        fun valueOfPackage(packageName: String): QQTypeEnum {
            val qqTypeEnums = values()
            for (qqTypeEnum in qqTypeEnums) {
                if (qqTypeEnum.packageName == packageName) {
                    return qqTypeEnum
                }
            }
            throw UnSupportQQTypeException("不支持的包名")
        }

        fun contain(packageName: String): Boolean {
            val qqTypeEnums = values()
            for (qqTypeEnum in qqTypeEnums) {
                if (qqTypeEnum.packageName == packageName) {
                    return true
                }
            }
            return false
        }
    }
}