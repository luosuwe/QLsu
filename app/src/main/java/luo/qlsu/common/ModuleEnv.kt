package luo.qlsu.common

/**
 * 模块自身的包信息。
 *
 * 注意：applicationId 是 `luo.QLsu`（用户指定），而代码/资源命名空间是 `luo.qlsu`。
 * 宿主里通过类名前缀判断“是不是本模块的 Activity”时，必须用这里的 PACKAGE，
 * 不能用 BuildConfig.APPLICATION_ID（两者大小写不同）。
 */
object ModuleEnv {
    const val PACKAGE = "luo.qlsu"
    const val APPLICATION_ID = "luo.QLsu"
}
