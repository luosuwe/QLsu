package luo.qlsu.autodaily.task.util

import android.util.Base64
import java.math.BigInteger
import java.security.KeyFactory
import java.security.MessageDigest
import java.security.interfaces.RSAPublicKey
import java.security.spec.X509EncodedKeySpec
import javax.crypto.Cipher
import javax.crypto.spec.SecretKeySpec

/**
 * XAutoDaily 的默认任务配置是「RSA(PKCS1) 包裹 AES-128 密钥 + AES/ECB/PKCS5 加密的 YAML」。
 *
 * 原版把这段放在 libxa_native.so 里（还顺手做了 V2 签名校验）。QLsu 里改成纯 Kotlin 实现：
 *  - RSA 公钥本身仍是凯撒位移过的（沿用原版，不影响兼容性）；
 *  - 用 RSA 公钥做 DECRYPT_MODE 等价于原生 RSA_public_decrypt；
 *  - AES-128/ECB/PKCS5Padding 与原生实现一致。
 *
 * 这样既可以直接吃 XAutoDaily 线上/内置的加密配置，又不需要 NDK / openssl 子模块。
 */
object XaConfCrypto {

    private const val ENC_RSA_PUBLIC_KEY =
        "GMJrGK0JYImJIMp3ZEOFKEWKK4JAKZYFaEXFhEYNiQdP15L4zogm4u" +
                "ERI4oTNdFOzts1LaU2i3EwbKMbxGYlNuarl9nKNqbVeA9h8f+BJSjO" +
                "kDrEIEX8Y/OjU6kuHixx6gEmR3wyoVEQX83IlUXeKNLMKlc1o88jY3" +
                "3GnojHG6oq7bnBwFMjQCvODaggH1ZiArlh1T+tuBobux9u0cMZKEKF"

    // 对应原生 CaesarCipher 的 UC_DECRYPT_CHARS / LC_DECRYPT_CHARS
    private const val UC_DECRYPT_CHARS = "NVPJQBMRSGAZIXEOHYLFWTUKCD"
    private const val LC_DECRYPT_CHARS = "ihwvsjtgkxmdqyeblfpanrzuoc"

    fun caesarDecrypt(src: String): String = buildString {
        for (ch in src) {
            when {
                ch in 'A'..'Z' -> append(UC_DECRYPT_CHARS[ch - 'A'])
                ch in 'a'..'z' -> append(LC_DECRYPT_CHARS[ch - 'a'])
                else -> append(ch)
            }
        }
    }

    fun publicKeyPem(): String = buildString {
        append("-----BEGIN PUBLIC KEY-----\n")
        append(caesarDecrypt(ENC_RSA_PUBLIC_KEY))
        append("\n-----END PUBLIC KEY-----")
    }

    /**
     * 原生实现是 RSA_public_decrypt（用公钥做模幂）。
     * Android 的 Cipher 不允许 public key + DECRYPT_MODE，这里直接 BigInteger.modPow，
     * 再手工去掉 PKCS#1 v1.5 填充。
     */
    fun decryptByPublicKey(encrypted: ByteArray): ByteArray? = runCatching {
        val keySpec = X509EncodedKeySpec(
            Base64.decode(caesarDecrypt(ENC_RSA_PUBLIC_KEY), Base64.DEFAULT)
        )
        val key = KeyFactory.getInstance("RSA").generatePublic(keySpec) as RSAPublicKey
        val m = BigInteger(1, encrypted).modPow(key.publicExponent, key.modulus)
        val raw = m.toByteArray()
        val bytes = if (raw.size > 1 && raw[0] == 0.toByte()) raw.copyOfRange(1, raw.size) else raw
        if (bytes.size < 11 || bytes[0] != 0.toByte() || bytes[1] != 1.toByte()) return null
        var i = 2
        while (i < bytes.size && bytes[i] == 0xFF.toByte()) i++
        if (i >= bytes.size || bytes[i] != 0.toByte()) return null
        bytes.copyOfRange(i + 1, bytes.size)
    }.getOrNull()

    /** 与 Java_..._ConfigUtil_decryptXAConf 等价。失败返回空数组。 */
    fun decrypt(src: String): ByteArray {
        if (src.length <= 171) return ByteArray(0)
        return runCatching {
            val encAesKey = Base64.decode(src.substring(0, 171) + "=", Base64.DEFAULT)
            val aesKey = decryptByPublicKey(encAesKey)
            if (aesKey == null || aesKey.size != 16) return ByteArray(0)
            val cipher = Cipher.getInstance("AES/ECB/PKCS5Padding")
            cipher.init(Cipher.DECRYPT_MODE, SecretKeySpec(aesKey, "AES"))
            cipher.doFinal(Base64.decode(src.substring(171), Base64.DEFAULT))
        }.getOrDefault(ByteArray(0))
    }

    /** 与 Java_..._ConfigUtil_getMd5Hex 等价。 */
    fun md5Hex(value: String): String {
        val digest = MessageDigest.getInstance("MD5").digest(value.toByteArray())
        return digest.joinToString("") { "%02x".format(it) }
    }
}
