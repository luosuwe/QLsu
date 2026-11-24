enableFeaturePreview("TYPESAFE_PROJECT_ACCESSORS")

pluginManagement {
    repositories {
        maven("https://maven.aliyun.com/repository/google")
        maven("https://maven.aliyun.com/repository/gradle-plugin")
        maven("https://mirrors.cloud.tencent.com/nexus/repository/maven-public/")
        gradlePluginPortal()
        google()
        mavenCentral()
    }
}

dependencyResolutionManagement {
    repositoriesMode.set(RepositoriesMode.FAIL_ON_PROJECT_REPOS)
    repositories {
        maven("https://api.xposed.info/") {
            content {
                includeGroup("de.robv.android.xposed")
            }
        }
        maven("https://maven.aliyun.com/repository/google")
        maven("https://mirrors.cloud.tencent.com/nexus/repository/maven-public/")
        maven("https://repo1.maven.org/maven2")
        maven("https://jitpack.io")
        google()
        mavenCentral()
    }
}

rootProject.name = "QLsu"
include(
    ":app",
    ":annotation",
    ":processor",
    ":qqinterface"
)