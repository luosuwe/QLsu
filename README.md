# QLsu

QQ / TIM 的 Xposed 功能模块，把 **QFun** 的功能与 **XAutoDaily** 的自动签到合并成一个 App。

> 当前为**内测版本**。

## 功能概览

- **消息**：防撤回、闪照查看、消息复读、多选撤回、语音转发、语音转文字
- **群聊**：防艾特全体、群打卡、自动续火、多拍一拍
- **净化**：去广告位、去弹窗、去链接预览、去 DIY 卡片
- **交互**：一键点赞、平板模式、自定义设备、QQ 设置页入口、加号面板入口
- **自动签到**：QQ 会员、超级会员、大会员、黄钻、QQ 打卡、情侣空间、王者荣耀等任务库
- **脚本**：BeanShell 脚本，可从在线脚本库获取

功能开关全部在模块 App 内，修改后按提示重启 QQ 生效。

## 环境要求

| 项目 | 要求 |
| --- | --- |
| Android | 9.0 及以上 |
| QQ / TIM | QQ 9.x、TIM 4.x |
| 框架 | LSPosed（Legacy / Modern API 101）、Zygisk |
| 构建 | JDK 21、Android SDK 37、Gradle Wrapper |

## 构建

```bash
./gradlew :app:assembleRelease -PjavaOnly=true
```

产物：`app/build/outputs/apk/release/app-release.apk`

`-PjavaOnly=true` 表示不编译 native，没有 NDK 也能出包；需要 Zygisk 注入时去掉该参数并使用完整 NDK 环境。

## 安装

1. 安装 APK
2. 在 LSPosed 中启用模块，作用域勾选 **QQ**（`com.tencent.mobileqq`）或 **TIM**
3. 重启 QQ / TIM
4. 打开 QLsu，按需开启功能

## 目录结构

```
app/           主程序：Compose 界面、Hook 入口、自动签到、脚本引擎
annotation/    注解定义（@HookItemAnnotation 等）
processor/     KSP 处理器，生成 HookRegistry
qqinterface/   QQ 接口声明与桩代码
gradle/        Gradle Wrapper
doc/           开发文档
qedge_mirror/  QQ Edge 镜像资源
qedge_shots/   界面截图
```

## 隐私

模块只会在激活时上报 **QQ 号** 与 **模块版本**，用于账号识别与更新检查。

Cookie、skey、pskey、pt4Token、设备信息等一律留在本机，不会上传。

## 许可与第三方

本项目遵循 **GNU General Public License v3.0**，完整协议见 [LICENSE](LICENSE)。

`
QLsu
Copyright (C) 2026 luosuwe

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
`

上游与第三方组件：

| 组件 | 许可 | 用途 |
| --- | --- | --- |
| [QFun](https://github.com/oneQAQone/QFun) | GPL-3.0 | 模块骨架、Hook 引擎、BeanShell 脚本 |
| [XAutoDaily](https://github.com/LuckyPray/XAutoDaily) | GPL-3.0 | 自动签到任务库 |
| BeanShell | Apache-2.0 | 脚本解释器 |
| libxposed API | Apache-2.0 | Modern Xposed 接口 |
| AndroidX / Jetpack Compose | Apache-2.0 | 界面 |
