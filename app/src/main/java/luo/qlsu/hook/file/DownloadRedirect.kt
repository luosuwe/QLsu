package luo.qlsu.hook.file

import android.os.Environment
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.base.BaseSwitchHookItem
import luo.qlsu.utils.qq.HostInfo
import luo.qlsu.utils.reflect.findField
import luo.qlsu.utils.reflect.toClass

@HookItemAnnotation(
    "下载重定向",
    "重定向下载路径到Download/QQ(TIM)",
    HookCategory.FILE,
    "All"
)
object DownloadRedirect : BaseSwitchHookItem() {

    override val isNeedRestart: Boolean = true

    private val redirectPath =
        "${Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DOWNLOADS)}/${HostInfo.hostName}/"

    override fun onHook() {
        if (isEnable) {
            "com.tencent.mobileqq.app.AppConstants".toClass
                .findField {
                    name = "SDCARD_FILE_SAVE_PATH"
                }.set(null, redirectPath)
        }
    }

}