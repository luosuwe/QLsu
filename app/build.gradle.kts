@file:Suppress("UnstableApiUsage")

import com.android.build.api.dsl.ApplicationExtension
import java.io.FileInputStream
import java.util.Properties
import java.util.UUID

plugins {
    alias(libs.plugins.android.application)
    alias(libs.plugins.ksp)
    alias(libs.plugins.protobuf)
    alias(libs.plugins.compose.compiler)
    alias(libs.plugins.kotlin.serialization)
}

val keystorePropertiesFile = rootProject.file("local.properties")
val keystoreProperties = Properties()
if (keystorePropertiesFile.exists()) {
    keystoreProperties.load(FileInputStream(keystorePropertiesFile))
}

// javaOnly=true 时不编译 Zygisk native（无 NDK 环境也能出可安装的 APK）
val javaOnly = (providers.gradleProperty("javaOnly").orNull ?: "false").toBoolean()

val modVersionCode = 42
val modVersionName = "1.7.4"

val zygiskOutputDir = layout.buildDirectory.dir("generated/zygisk-resources")

val processZygiskTemplate = tasks.register<Sync>("processZygiskTemplate") {
    description = ""
    from(file("src/main/zygisk-template"))
    into(zygiskOutputDir)
    filteringCharset = "UTF-8"
    filesMatching("module.prop") {
        expand(
            mapOf(
                "version" to modVersionName,
                "versionName" to modVersionName,
                "versionCode" to modVersionCode,
                "uuid" to UUID.randomUUID().toString()
            )
        )
    }
    doLast {
        val carriageReturn = '\r'.code.toByte()
        zygiskOutputDir.get().asFile.walkTopDown()
            .filter { it.isFile }
            .forEach { file ->
                val bytes = file.readBytes()
                if (bytes.contains(carriageReturn)) {
                    file.writeBytes(bytes.filter { it != carriageReturn }.toByteArray())
                    logger.lifecycle("processZygiskTemplate: normalize CRLF -> LF  ${file.name}")
                }
            }
    }
}

tasks.named("preBuild").configure {
    dependsOn(processZygiskTemplate)
}

extensions.configure<ApplicationExtension> {
    namespace = "luo.qlsu"
    if (!javaOnly) {
        ndkVersion = "30.0.16248370"
    }
    compileSdk = 37

    defaultConfig {
        applicationId = "luo.QLsu"
        buildToolsVersion = "37.0.0"
        minSdk = 26
        targetSdk = 36
        versionCode = modVersionCode
        versionName = modVersionName

        ndk {
            abiFilters.add("arm64-v8a")
            abiFilters.add("armeabi-v7a")
        }

        if (!javaOnly) {
            externalNativeBuild {
                cmake {
                    arguments += listOf(
                        "-DANDROID_STL=none",
                        "-DLSPLANT_STANDALONE=ON",
                        "-DANDROID_SUPPORT_FLEXIBLE_PAGE_SIZES=ON"
                    )
                }
            }
        }
    }

    sourceSets {
        named("main") {
            resources.srcDir(zygiskOutputDir.get().asFile)
        }
    }

    signingConfigs {
        create("release") {
            keyAlias = keystoreProperties.getProperty("keyAlias") ?: ""
            keyPassword = keystoreProperties.getProperty("keyPassword") ?: ""
            storePassword = keystoreProperties.getProperty("storePassword") ?: ""
            val storeFileName = keystoreProperties.getProperty("storeFile") ?: ""
            if (storeFileName.isNotEmpty()) {
                storeFile = file(storeFileName)
            }
        }
    }

    buildFeatures {
        buildConfig = true
        compose = true
        prefab = true
    }

    buildTypes {
        release {
            isMinifyEnabled = true
            isShrinkResources = true
            signingConfig = signingConfigs.getByName("release")
            proguardFiles(
                getDefaultProguardFile("proguard-android-optimize.txt"),
                "proguard-rules.pro"
            )
        }
    }

    if (!javaOnly) {
        externalNativeBuild {
            cmake {
                path = file("src/main/cpp/CMakeLists.txt")
                version = "3.28.0+"
            }
        }
    }

    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_21
        targetCompatibility = JavaVersion.VERSION_21
    }

    androidResources {
        additionalParameters += listOf(
            "--allow-reserved-package-id",
            "--package-id",
            "0x44",
        )
        // 任务配置密文需要被原样读取，避免 aapt 压缩后 getResourceAsStream 读不到
        noCompress += listOf("default_conf")
    }

    packaging {
        resources {
            excludes += setOf(
                "META-INF*.proto"
            )
            pickFirsts += setOf(
                "META-INF/xposed/**",
                "META-INF/services/**",
                "customize.sh",
                "action.sh",
                "uninstall.sh",
                "module.prop",
                "webroot/**",
                "META-INF/com/google/android/update-binary",
                "META-INF/com/google/android/updater-script"
            )
        }
    }
}

dependencies {
    implementation(libs.androidx.annotation)
    implementation(libs.androidx.core.ktx)
    implementation(libs.kotlinx.coroutines.android)
    implementation(libs.kotlinx.serialization.json)
    implementation(libs.dalvik.dx)
    implementation(libs.libxposed.service)
    implementation(projects.annotation)
    implementation(libs.dexkit)
    implementation(libs.protobuf.java)

    implementation(platform(libs.compose.bom))
    implementation(libs.compose.ui)
    implementation(libs.compose.ui.graphics)
    implementation(libs.compose.ui.tooling.preview)
    implementation(libs.compose.material3)
    implementation(libs.compose.activity)
    implementation(libs.compose.animation)
    implementation(libs.lifecycle.viewmodel.compose)
    implementation(libs.lifecycle.runtime.compose)
    implementation(libs.kyant0.backdrop)
    implementation(libs.kyant0.shapes)

    implementation(libs.dobby)
    implementation(libs.libcxx)

    // ---- AutoDaily（XAutoDaily 任务引擎）移植所需依赖 ----
    implementation("com.squareup.okhttp3:okhttp:4.12.0")
    implementation("cn.hutool:hutool-core:5.8.32")
    implementation("com.charleskorn.kaml:kaml:0.55.0")

    ksp(projects.processor)

    compileOnly(libs.libxposed.api)
    compileOnly(libs.xposed)
    compileOnly(projects.qqinterface)

    testImplementation(libs.junit)
}

protobuf {
    protoc {
        artifact = "com.google.protobuf:protoc:4.36.2"
    }

    generateProtoTasks {
        all().forEach { task ->
            task.builtins {
                create("java") {
                    option("lite")
                }
            }
        }
    }
}

val adb: String = androidComponents.sdkComponents.adb.get().asFile.absolutePath
val packageName = "com.tencent.mobileqq"
// adb shell am force-stop com.tencent.mobileqq
val killQQ = tasks.register<Exec>("killQQ") {
    description = ""
    group = "qlsu"
    commandLine(adb, "shell", "am", "force-stop", packageName)
    isIgnoreExitValue = true
}
