package luo.qlsu.conf

import kotlinx.serialization.Serializable

@Serializable
data class MenuConfig(
    val hiddenNames: String = ""
)