<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>在线脚本列表 - QLsu</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="../index.php" class="navbar-brand">
                <span class="brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                </span>
                QLsu
            </a>
            <div class="navbar-nav">
                <a href="../index.php">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span>首页</span>
                </a>
                <a href="list.php" class="active">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </span>
                    <span>在线脚本</span>
                </a>
                <a href="../user/login.php">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span>用户中心</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">在线脚本列表</h1>
            <p class="page-subtitle">共 81 个脚本</p>
        </div>

        
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-input" placeholder="搜索脚本名、作者或QQ..." value="">
            <button class="btn btn-primary" onclick="doSearch()">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                搜索
            </button>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px;">
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">聊天记录归档搜索</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: chat_archive_001</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.05</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                7 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">自动把收到的所有聊天消息归档为 JSONL，支持：
- 长按消息菜单：搜索聊天记录 / 导出本会话
- 聊天内指令：#搜索关键词 / #导出 / #导出全部 / #统计
- 本地全文检索（ASCII 词 + 中文二元组倒排索引 + 子串兜底）
- 一键导出 Markdown / HTML / JSON

数据目录：插件目录/archive/&amp;lt;当前UIN&amp;gt;/</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>QLsu-Lab</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3089537356</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-22 17:53:29</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=263" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">AI自动回复框架</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Basil13258</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v11.0.5</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                24 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">由于 QE 限制, 所以我懒得写了</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>n主开发:青Basil QQ:3901654825</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3953724697</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-22 17:32:55</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=262" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">Tiax语音合成</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: tiax_tts</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                143 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">2.1
&amp;lt;&amp;gt;fish模型库: 全量 45254 个模型(随包 fish_models.txt)
&amp;lt;&amp;gt;搜索改为[搜索]按键触发, 输入关键词点一下即可, 回车也可
&amp;lt;&amp;gt;模型库(tiax 458个)同样改为搜索按键
&amp;lt;&amp;gt;新增[fish模型库]菜单: fish.audio 语音库 1000 个模型(随包 fish_models.txt)
&amp;lt;&amp;gt;内置 81 个中文模型兜底, 按名称/语言(zh,en)/id 搜索
&amp;lt;&amp;gt;单击保存为 kl:&amp;lt;id&amp;gt; 语音模型, 长按试听, 支持在线刷新
&amp;lt;&amp;gt;新增[模型库]菜单: 自动抓取模型网站全部语音模型
&amp;lt;&amp;gt;支持按 id / 名称搜索, 单击保存到语音模型, 长按试听, 刷新
2.0
修复silk无法转换问题
1.0
Tiax 文字转语音：发送 .tts 文字 即可合成并发送语音。
&amp;lt;&amp;gt;    支持自定义模型 无需token即可生成语音
&amp;lt;&amp;gt;    模型地址   https://fish.audio/app/
&amp;lt;&amp;gt;    key地址   https://www.tiax.pw/user/index.php
&amp;lt;&amp;gt;    支持转silk，发送历史音频，删除历史音频，拦截消息直接发语音等
&amp;lt;&amp;gt;    有问题找冷雨
&amp;lt;&amp;gt;    教程   【腾讯文档】Tisx文转语教程 https://docs.qq.com/doc/DVnZwcFNKd0p4R3V2</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">脚本启动即调用 sendZan 对指定账号批量点赞 50 次，属于明确的刷赞行为。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-18 00:56:29</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=259" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">MC服务器查询</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: mc_server_manager</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.5</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                4 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">&amp;gt;🔍 MC服务器查询插件 v2.5

一款功能完整的Minecraft服务器状态查询工具
问题反馈群：1004234439

✨ 主要功能：
• 📋 多服务器管理 - 保存多个常用服务器
• ➕ 友好添加界面 - 填写名称、地址、类型
• 🗑️ 便捷管理 - 列表查看、删除服务器
• 🖼️ 自动显示服务器图标
• 📊 显示在线状态、玩家数、版本、MOTD
• 全面的升级增加了许多功能UI仿照的是另一款QQ音乐模块
8月16日：修复已知bug
10月9日：增加了部分功能
📋 使用方法：
• 命令：/mc 显示服务器列表
• 命令：/mc &amp;lt;地址&amp;gt; 查询指定服务器
• 悬浮窗菜单：服务器列表 / 添加服务器 / 管理服务器

🔄 数据持久化保存，重启不丢失

📌 版本：2.5 | 作者：AI/NL</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fff4e5; color: #b26a00;">
                            <div style="font-weight: 500;">AI 建议：转人工</div>
                            <div style="margin-top: 2px;">main.java 内容被截断，无法完整审计剩余代码，建议人工核查是否存在违规。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>AI/NL</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2364116972</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-17 21:46:51</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=257" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">聊天记录归档搜索</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: chat_archive_001</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                14 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">自动把收到的所有聊天消息归档为 JSONL，支持：
- 长按消息菜单：搜索聊天记录 / 导出本会话
- 聊天内指令：#搜索关键词 / #导出 / #导出全部 / #统计
- 本地全文检索（ASCII 词 + 中文二元组倒排索引 + 子串兜底）
- 一键导出 Markdown / HTML / JSON

数据目录：插件目录/archive/&amp;lt;当前UIN&amp;gt;/</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">缺少 onMsg 回调，消息归档与聊天指令永不触发，核心功能无法运行，且访问 MsgData 不存在的字段。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>QLsu-Lab</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3089537356</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-14 14:09:23</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=254" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">猜数字游戏</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1791713769793</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                22 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">随机1-100猜数字，分为普通模式和积分翻倍模式每日签到获取积分
猜数字菜单--查看指令</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">脚本加载后自动给指定账号 1025671812 刷 50 个赞，属刷赞行为，违反标准 2。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>ee</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>1634047002</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-12 02:29:33</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=253" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">Tiax语音合成</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: tiax_tts</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                93 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">2.0
修复silk无法转换问题
1.0
Tiax 文字转语音：发送 .tts 文字 即可合成并发送语音。
&amp;lt;&amp;gt;    支持自定义模型 无需token即可生成语音
&amp;lt;&amp;gt;    模型地址   https://fish.audio/app/
&amp;lt;&amp;gt;    key地址   https://www.tiax.pw/user/index.php
&amp;lt;&amp;gt;    支持转silk，发送历史音频，删除历史音频，拦截消息直接发语音等
&amp;lt;&amp;gt;    有问题找冷雨
&amp;lt;&amp;gt;    教程   【腾讯文档】Tisx文转语教程 https://docs.qq.com/doc/DVnZwcFNKd0p4R3V2</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">main.java 末尾 sendZan 启动即给指定账号点 50 赞，属刷赞违规行为。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-11 21:49:38</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=252" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">网易云 bilibili 点歌</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: netease_song_v2</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v11.11</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                104 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">点歌 · QLsu 插件 — 双源搜索，一键发歌

作者 刘雨欣 · QQ 3633190269 · 交流群 1128443365 · 版本 2026.10.13

用法：发「点歌」开面板；发「点歌 歌名」直接搜；回复数字选结果。
支持：网易云 / B站，封面 / 语音 / 视频 / 卡片，缓存复用，群黑白名单。

仅供学习交流 · 禁止二改 / 倒卖 / 商用</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fff4e5; color: #b26a00;">
                            <div style="font-weight: 500;">AI 建议：转人工</div>
                            <div style="margin-top: 2px;">main.java 超限截断未完整提供，无法通读全部源码，需人工核查完整文件。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-11 12:58:16</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=251" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">Tiax语音合成</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: tiax_tts</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.2</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                55 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">Tiax 文字转语音：发送 .tts 文字 即可合成并发送语音。
&amp;lt;&amp;gt;    支持自定义模型 无需token即可生成语音
&amp;lt;&amp;gt;    模型地址   https://fish.audio/app/
&amp;lt;&amp;gt;    key地址   https://www.tiax.pw/user/index.php
&amp;lt;&amp;gt;    支持转silk，发送历史音频，删除历史音频，拦截消息直接发语音等
&amp;lt;&amp;gt;    有问题找冷雨
&amp;lt;&amp;gt;    教程   【腾讯文档】Tisx文转语教程 https://docs.qq.com/doc/DVnZwcFNKd0p4R3V2</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">main.java 末尾启动即 sendZan 指定账号 50 次，属刷赞，命中第2条。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-08 19:17:22</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=250" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">改版名言作图</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: mingyan_zuotu</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.7.2</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                39 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">名言作图：长按聊天里的文字消息，选「名言作图」，自动排成一张竖版卡片图并发回原会话。
正文用竖线分隔作者，例如：我们都在阴沟里，但仍有人仰望星空。|王尔德
可选把 font.ttf 和 bg.jpg 放进脚本目录，缺省时用系统字体和纯色背景。</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">代码末尾硬编码 sendZan(&quot;3362541477&quot;,20) 给指定账号批量刷赞，命中刷赞违规。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>沄,MySQLdisappoint</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-04 18:24:08</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=246" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">语音合成puls</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: luosuyyhc</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                267 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">优点：有独立的脚本窗口UI，反应迅速快捷，搜索到模型后点击即可使用该模型
缺点：部分模型合成可能会失败，但不影响绝大多数模型
模型数量：据可靠消息当前的模型数量已有2000+

更新日志
v2026.11.3 21:23
优化模型搜索结果滑动</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fdecea; color: #c62828;">
                            <div style="font-weight: 500;">AI 建议：拒绝</div>
                            <div style="margin-top: 2px;">main.java 将全部业务代码 Base64 编码，运行时解码后 eval／loadJava 动态执行，规避源码审计，命中第 1 条。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>洛苏</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3498573556</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-04 00:04:41</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=245" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">多功能</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Grok</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v9.7</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                263 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">新增许多功能并优化了兼容性 下来玩玩👍🏻非常实用
_grok</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>726329</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2811094816</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-02 16:14:35</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=242" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">每日早报</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: AGCOI</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v9.6</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                28 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">随着时代的变更，AI时代已经流向每个开发者的想法里，
更新公告可看弹幕  这次更新特别多，自己琢磨，有好玩的
感谢夏风老师  夏风群聊：99299709 )grok openai claude对本次项目作出贡献!
测试群：1124117541  欢迎进群测试，项目维护时间尚不明确
新增导航滑动 新增谷歌地图（test） 新增YouTubemusic（test） 优化高德地图定位
优化音乐效率稳定性 新增地震预警 新增毛玻璃调节 回退删除冗杂功能。
改善天气匹配优化，修复天气特效功能部分失效bug等问题 新增音乐MV功能 链接功能 。
你们如果有新功能添加，自己可以改来试。
主导者：726329 欢迎您的使用，如有问题可随时告诉我，我会尽力解决。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>布风</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2811094816</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-11-01 17:30:32</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=240" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">每日人民日报</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: daily_rmrb_20261031</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v26.10.31</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                25 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);"># language: text, file: desc.txt
每日人民日报推送脚本

功能说明：
- 每天指定时间（默认 08:00）自动拉取当日人民日报版面文本
- 推送到指定群（脚本内 TARGET_GROUP 修改）
- 当日去重：同一天只推送一次，脚本重载不会重复发送
- 支持脚本启动时补发：如果过了设定时间才启动，会补发当天内容
- 聊天页面菜单提供「手动推送人民日报」按钮，可在任意群手动触发一次

配置修改（main.java 顶部）：
TARGET_GROUP  目标群号
SEND_HOUR     推送小时（0-23）
SEND_MINUTE   推送分钟（0-59）
API_URL       数据源地址

数据源：https://xiaoqi.icofun.cn/API/rmrb.php?type=text</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-31 23:41:16</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=238" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">Tiax语音合成</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: tiax_tts</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                73 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">Tiax 文字转语音：发送 .tts 文字 即可合成并发送语音。
&amp;lt;&amp;gt;    支持自定义模型 无需token即可生成语音
&amp;lt;&amp;gt;    模型地址   https://fish.audio/app/
&amp;lt;&amp;gt;    key地址   https://www.tiax.pw/user/index.php
&amp;lt;&amp;gt;    支持转silk，发送历史音频，删除历史音频，拦截消息直接发语音等
&amp;lt;&amp;gt;    有问题找冷雨
&amp;lt;&amp;gt;    教程   【腾讯文档】Tisx文转语教程 https://docs.qq.com/doc/DVnZwcFNKd0p4R3V2</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-30 14:56:25</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=207" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">勇者奶蛙传</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: yongzhe_naiwa_h5</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                40 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">【勇者奶蛙传 - 3D 悬浮冒险】

无需切出 QQ，一边聊天一边拯救公主。基于在线 H5 引擎的横版动作冒险游戏，独立悬浮窗运行。

====== 核心特色 ======
安全隔离：纯在线加载，不读取本地沙盒，不干扰 QQ 正常使用。
原生适配：游戏自带手机触控与手游按键布局，左侧摇杆走位，右侧释放技能。
进度保存：基于 WebView 的 localStorage，聊天途中退出游戏也能自动存档。
====== 操作说明 ======
悬浮球：点击左上角“奶蛙”悬浮球全屏展开游戏。
退出游戏：点击右上角圆形“×”按钮收起。
关闭插件：在 QLsu 脚本菜单中停止运行。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-28 23:58:47</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=200" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">MiniCSGO</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: mini_csgo_web</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                35 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">【Mini CSGO - 3D 悬浮射击】

无需切出 QQ，边聊边打。基于 Three.js 打造的纯移动端第一人称射击游戏。独立悬浮窗运行，不影响聊天输入，包含丰富的武器系统、智能 AI 敌人以及全功能外挂面板。

====== 核心特色 ======
无缝双开：独立悬浮窗，全局覆盖，聊天游戏两不误。
武器库：VK-47 突击步枪、M-200 重狙、P9 手枪自由切换。
智能敌人：模拟真实寻路，具有视线遮挡检测（绝不穿墙打人）。
全功能外挂：自瞄锁头/锁胸、子弹追踪与穿透、透视射线描框、一键全开等 16 项定制功能。
移动端优化：低延迟触控，左侧浮动摇杆 + 右侧滑动视角 + 大号操作按键。

====== 操作说明 ======
移动：左半屏任意位置按下拖动（浮动摇杆）。
视角：右半屏滑动拖动。
开火/开镜/跳跃/换弹/切枪：右下角对应圆形按钮。
外挂面板：点击左上角血条下方的 [外] 按钮呼出。
飞行模式：开启后屏幕左侧会出现 上下 升降键。

====== 开发者提示 ======
游戏内包含网络 CDN 依赖，初次加载请确保手机网络通畅。
击杀、爆头有屏幕中心提示与左上角播报，死亡后点击“再来一局”即可满血复活。
如遇黑屏，请尝试开启代理或检查网络。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-28 22:34:20</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=197" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">简约点歌</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: dian_ge_20261027</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v26.10.27</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                127 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">网易云 QQ点歌脚本

简介

基于 QLsu 框架的 QQ 点歌脚本。发送「点歌 歌名」即可搜索网易云音乐并发送音乐卡片，开启语音模式后自动下载并发语音条。支持列表翻选、群黑白名单、总开关。

菜单功能

在聊天页长按右上角或右下角打开脚本菜单。

点歌帮助，弹窗显示帮助，不发群。
总开关，一键开启或关闭所有消息响应。
切换语音模式，点序号时发语音或发卡片，状态自动保存。
加白当前群，把当前群加入白名单。
加黑当前群，把当前群加入黑名单。
移出黑白名单，把当前群从名单中移除。
查看名单，弹窗显示当前黑白名单。

命令列表

点歌 歌名，搜索并发第一首。支持括号，如点歌《琵琶曲》。
点歌列表 歌名，列出前五首并缓存，十分钟有效。
点 N 或点歌 N，发送缓存第 N 首，受语音模式影响。
语音 N 或点歌语音 N，强制发送第 N 首语音。
查看名单，弹窗显示黑白名单。
加白 / 加黑，在群里发送即操作当前群，带群号则操作指定群。
删白 / 删黑 群号，从名单移除指定群。

黑白名单规则

白名单为空时所有群允许，非空时只允许名单内群。黑名单优先于白名单。私聊只受总开关控制。

语音发送说明

首次发语音会下载音频到插件目录 voice 文件夹，文件名格式为歌名加歌手，重复点歌直接秒发。拿不到音源、文件超限、格式不支持或下载失败时自动降级发卡片。状态提示均为弹窗，不发群消息。

音源说明

搜索使用网易云公开 API，音源采用多镜像轮询并自动重试。部分版权歌曲无音源，降级发卡片，卡片走 QQ 音乐播放器。

版本与作者

版本 26.10.27，作者 刘雨欣。所有功能均基于 QLsu 官方 API，无外部依赖，无需配置服务器，开箱即用。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-27 23:16:24</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=196" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">选因的工具箱</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: toolbox</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v0.0.8</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                149 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">0.0.1
集成了以往本人发布及未发布的所有插件，后续功能仅在该工具箱更新
具体功能包含伪造合并转发、自动贴表情、假接龙、QQ 版本查看等
0.0.2
修复伪造合并转发卡片无法发出并静默报错问题
0.0.3
增加假头衔以及伪造表情回复数量
0.0.3.2
修复卡死问题
0.0.4
更新: 
1. QQ 版本查看双模式（精准/标准) 
2. 四条空消息,并与不支持查看合并为滚木五件套；伪造文件消息以及链接消息
3. 入群答题验证新增验证队列
4. 删除共享定位自动替换功能，发送方式改为直发
5. 增加自动加载设置，默认全关，防止一次性加载过多模块导致卡死、闪退问题;若配置中含某模块功能已开启，会自动加载对应模块防止运行时功能缺失
修复了不知道什么 bug 
0.0.4.1
修了一个 bug
0.0.4.2
更新了一个节日红包，需要真实发出一个红包
0.0.4.3
修了一个 bug
0.0.4.4
修了一个 bug
0.0.5
新增QQ图床
0.0.5.1 / 0.0.5.2
修了一个 bug
0.0.6
新增伪造礼物消息和伪造表情弹射
自动回应表情更新更多表情，并重写表情选择面板为悬浮菜单
伪造合并转发支持 Ark 卡片以及 QQ 原生表情，消息列表卡片首行显示更详细的信息（头像预览+昵称+uin+时间）
更新拓展模块：消息胎记
0.0.6.1
重写了 QQ 版本查看角标
此版本发布仅为顶掉不知名0.0.7版本，可能有 bug
0.0.6.2
修复假头衔失效
0.0.6.3
版本表新增 Watch QQ 和 Linux QQ
0.0.7
更新在线模块：留言板（包含留言和投票功能）
QQ 版本查看新增同步远端subid表
新增公共面板公告栏
0.0.8
更新群快捷栏自定义
更新自定义个性装扮
更新自动发视频卡片（egame卡）
更新发包禁言（不在群也可以禁）
更新Miuix风格UI</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>选因因</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2021805519</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-26 21:31:35</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=193" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">简约点歌</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: dian_ge_20261026</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v26.10.26</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                27 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">网易云 QQ点歌脚本

简介

基于 QLsu 框架的 QQ 点歌脚本。发送「点歌 歌名」即可搜索网易云音乐并发送音乐卡片，开启语音模式后自动下载并发语音条。支持列表翻选、群黑白名单、总开关。

菜单功能

在聊天页长按右上角或右下角打开脚本菜单。

点歌帮助，弹窗显示帮助，不发群。
总开关，一键开启或关闭所有消息响应。
切换语音模式，点序号时发语音或发卡片，状态自动保存。
加白当前群，把当前群加入白名单。
加黑当前群，把当前群加入黑名单。
移出黑白名单，把当前群从名单中移除。
查看名单，弹窗显示当前黑白名单。

命令列表

点歌 歌名，搜索并发第一首。支持括号，如点歌《琵琶曲》。
点歌列表 歌名，列出前五首并缓存，十分钟有效。
点 N 或点歌 N，发送缓存第 N 首，受语音模式影响。
语音 N 或点歌语音 N，强制发送第 N 首语音。
查看名单，弹窗显示黑白名单。
加白 / 加黑，在群里发送即操作当前群，带群号则操作指定群。
删白 / 删黑 群号，从名单移除指定群。

黑白名单规则

白名单为空时所有群允许，非空时只允许名单内群。黑名单优先于白名单。私聊只受总开关控制。

语音发送说明

首次发语音会下载音频到插件目录 voice 文件夹，文件名格式为歌名加歌手，重复点歌直接秒发。拿不到音源、文件超限、格式不支持或下载失败时自动降级发卡片。状态提示均为弹窗，不发群消息。

音源说明

搜索使用网易云公开 API，音源采用多镜像轮询并自动重试。部分版权歌曲无音源，降级发卡片，卡片走 QQ 音乐播放器。

版本与作者

版本 26.10.26，作者 刘雨欣。所有功能均基于 QLsu 官方 API，无外部依赖，无需配置服务器，开箱即用。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-26 18:53:28</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=189" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">mj</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: mj</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                64 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">检测到关键词 &amp;quot;mj&amp;quot; 时，自动随机发送两个预设视频中的一个。

## 功能
- 监听消息，检测关键词 mj
- 触发后随机发送两个视频之一（sendVideo）
- 自动记录日志

## 注意
- 视频地址需要在 main.java 中配置（本地路径或网络 URL）</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #e8f5e9; color: #2e7d32;">
                            <div style="font-weight: 500;">AI 建议：通过</div>
                            <div style="margin-top: 2px;">脚本代码清晰，无混淆恶意行为，语法正确，符合上架规范。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>梦休</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3595533075</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-24 22:48:33</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=185" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">猜谜</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Guess_a_riddle</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v3.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                31 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">┌─────────────────────────────────┐
│   🧩 猜谜 / 脑筋急转弯  v3.0    │
└─────────────────────────────────┘

【插件简介】
全群互动猜谜游戏，支持 🌐 网络题库 + 📚 本地题库双题源，
网络获取失败自动回落本地，永不冷场。
答题匹配忽略空格、大小写、标点，支持多答案。

【游戏指令】
  猜谜          → 🌐 网络随机出题（3 次机会）
  猜谜 本地     → 📚 本地题库出题
  猜谜 难       → 🔥 出难题（积分更高）
  答 xxx        → 提交答案（如: 答 影子）
  提示          → 💡 获取线索（答对积分减半）
  跳过          → 🏳️ 放弃本题看答案
  谜题帮助      → 📖 指令说明
  谜题榜        → 🏆 查看本群积分榜 Top10

【积分规则】
  ⭐ 简单题 …… 1 分
  ⭐ 网络题 …… 2 分
  ⭐ 难题   …… 3 分
  💡 使用提示后答对，积分减半（至少 1 分）

【脚本菜单】
  🔌 猜谜群开关 → 在当前群开启/关闭猜谜
  📋 题库状态   → 查看本地题库加载情况与题目数

【题库文件】
  题库独立存放于 riddle_bank.java（与 main.java 同目录），
  添加题目只需编辑该文件，格式：
  {&amp;quot;题目&amp;quot;, &amp;quot;答案1|答案2&amp;quot;, &amp;quot;提示&amp;quot;, &amp;quot;简单&amp;quot;, 积分}
  改完关闭再开启插件即可热更新。

【防刷机制】
  ✅ 消息 ID 去重（防指令重复触发）
  ✅ 回复 1.5 秒节流（防消息轰炸）
  ✅ 指令预过滤（非猜谜消息零开销）

【注意事项】
  · 需先在目标群开启「猜谜群开关」才响应指令
  · 网络题源: api.52vmy.cn（免费接口，超时 5 秒自动回落）
  · 积分数据保存在内存中，重启插件后清零</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>glm5.3-flash 和 deepseek flash</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>153274783</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-18 09:39:57</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=178" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">五子棋(deepseek)</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: wzq1</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v6.2</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                55 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">【主要功能】

· 双人对战：发送「开始」创建棋局，发送「加入」成为白方。
· 人机对战：发送「人机」与 AI 对战，玩家执黑先行。
· 自定义棋盘：发送「设置棋盘 19」或「尺寸 19」，支持 9~21 路，默认 15 路。
· 坐标落子：直接发送坐标，如 H8、A1、K15。
· 图片棋盘：自动渲染带坐标的棋盘图片；发图失败自动回退文字棋盘。
· 复盘回放：对局结束/认输/手动结束后，发送「复盘」或「回放」查看带落子步数标号的复盘图。
· 群聊开关：通过菜单「五子棋群开关」控制本群是否启用。
· 存档管理：进行中棋局自动保存，支持查看棋盘、结束棋局、重开棋局</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>deepseek-flash</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>153274783</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-18 09:39:49</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=177" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">扫雷4.3</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: saolei1</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v4.3</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                41 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">【💣 扫雷 For QFun】

经典扫雷搬进QQ群聊，全群合作一起排雷！

▎玩法
同一会话共用一张棋盘，群友轮流挖格子：
· 挖开数字格 → 数字 = 周围8格的雷数，据此推理
· 挖开 0️⃣ → 自动扩散展开一大片
· 踩到雷 → 💥 全团暴毙，公开雷区
· 揭开全部安全格 → 🎉 胜利，统计用时破群纪录

▎指令（直接发送，无需前缀）
· 扫雷 → 开局（简单10雷）
· 扫雷 中等 / 扫雷 困难 → 20雷 / 35雷
· 挖 x,y → 挖开格子，如: 挖 3,4
· 旗 x,y → 插旗标记疑雷
· 雷图 → 查看棋盘进度
· 弃雷 → 放弃并公开所有雷
· 扫雷帮助 → 完整指令说明

▎特色
· 🛡 防重复：消息去重 + 回复节流双防线，绝不刷屏
· 💾 断线无忧：棋局实时持久化，重启QQ不丢局
· 📊 群合作播报：每次挖掘都带挖雷人昵称，胜负分明

▎适合
群聊整活、摸鱼互动、多人比拼推理。一个人也能和AI斗智斗勇。</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #e8f5e9; color: #2e7d32;">
                            <div style="font-weight: 500;">AI 建议：通过</div>
                            <div style="margin-top: 2px;">源码可读无混淆、无刷数据，语法合法，核心扫雷逻辑完整，未定义API均有兜底降级。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>glm5.3-flash and deepseek</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>153274783</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-18 08:53:00</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=175" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">伪造上线通知</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1792231970270</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                74 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">由模了个块移植，配置在文件目录下可以自己改

*声明：
禁止在未经允许的情况下二改、搬运本脚本
可适当作参考借鉴思路*

*再次声明：
仅在Android9.3.55进行测试无误，其他版本不知道，用不了可以向我反馈*</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #e8f5e9; color: #2e7d32;">
                            <div style="font-weight: 500;">AI 建议：通过</div>
                            <div style="margin-top: 2px;">代码结构清晰、无混淆/刷数据/语法错误，功能为伪造上线通知，属于正常扩展范围。</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>xinyue（3750187753）</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3750187753</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-17 18:20:23</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=172" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">网易云 bilibili 点歌</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: netease_song_v2</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v10.13</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                177 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">点歌 · QLsu 插件 — 双源搜索，一键发歌

作者 刘雨欣 · QQ 3633190269 · 交流群 1128443365 · 版本 2026.10.13

用法：发「点歌」开面板；发「点歌 歌名」直接搜；回复数字选结果。
支持：网易云 / B站，封面 / 语音 / 视频 / 卡片，缓存复用，群黑白名单。

仅供学习交流 · 禁止二改 / 倒卖 / 商用</div>
                                                                                                                        <div style="font-size: 13px; line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; border-radius: var(--radius-sm); background: #fff4e5; color: #b26a00;">
                            <div style="font-weight: 500;">AI 建议：转人工</div>
                            <div style="margin-top: 2px;">缺少 lib 目录下的 .bsh 库文件内容，无法判断是否调用了未定义函数或存在其他违规</div>                        </div>
                                                <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-13 19:12:58</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=169" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">片语 AI 聊天</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: ai_chat_script</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2026.10.10</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                73 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">片语

一个 AI model 聊天脚本需配置 API 接口和密钥
只言片语，够用就好。
能一句说完，不写两段。
对话、写码、翻译、翻旧事，都能接。
触发：吃白饭，或直接 @机器人。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-10 15:49:45</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=164" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">解除群多选撤回上限</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: troop_recall_unlock</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                108 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">把 QQ 多选撤回的上限从 10 条改为无限制（默认 99 条）。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3635522745</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-10 08:54:09</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=162" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">语音整点报时</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: hourly_voice_tts_001</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2026.10.09.21:00</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                55 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">语音报时

——“现在是几点？”——这是人间最朴素的问句，也是时间最温柔的回响。

本脚本基于 QLsu，让 QQ 群里的整点报时不再是一行冰冷的文字，
而是由 TTS 合成的一段真切的语音，在指定的时刻，轻轻落在你所在的群里。

它可以是北京时间清晨的一声“早上好”，
也可以是东京、纽约、伦敦的某个遥远时区里，此刻正发生着的故事。

你可以选择的：
· 时刻——任意你想要的 HH:mm，如 08:30 的早安，12:30 的午饭，22:00 的晚安
· 群聊——一次配置，多处响起，或只在一个安静的角落独自播报
· 时区——北京、东京、首尔、新加坡、迪拜、伦敦、巴黎、莫斯科、纽约、洛杉矶、悉尼、UTC
· 音色——从 kktts 音色列表中，挑一个你愿意长久听下去的声音
· 内容——用模板写下你想说的话，让时间为你朗读

模板占位符：
  本地时间：{hh} {H} {mm} {ss} {yyyy} {MM} {dd}
  目标时区：{tz_hh} {tz_H} {tz_mm} {tz_ss} {tz_yyyy} {tz_MM} {tz_dd} {tz_name} {tz_offset}

预设文案（一键填入，可再修改）：
  · 通用：时:分 / 整点 / 年月日时分秒 / 本地时间
  · 猫娘：猫娘·哥哥 / 猫娘·姐姐 / 猫娘·喵
  · 温柔：温柔提醒 / 吃饭啦 / 该睡觉了
  · 可爱：抱抱 / 贴贴 / 么么哒
  · 其它：元气满满 / 打工人 / 晚安

两套 TTS 引擎，各有所长：
  · kktts——支持自定义文本与音色选择，适合“哥哥~现在是…”这类私人化的问候
  · s01s zdbs——固定整点报时语音，无参数，简洁稳妥，适合只求报时、不念他话

其它：
  · 可在当前群一键试听，确认无误再开启
  · 脚本重载后自动恢复上次运行状态
  · 单入口菜单：所有配置尽在「报时设置」一屏之内

时间本无声。你让它开口，它便有了声音。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-09 21:14:46</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=160" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">自动群打卡</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Change_clockIn</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                360 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">支持批量勾选群聊，一键启用/关闭自动打卡，每日首次收到消息时自动为已选群执行打卡，无需手动操作。

核心功能：

· 菜单批量管理：弹出群列表，勾选即启用
· 每日自动打卡：静默运行，当天首次成功打卡才提示
· 手动立即打卡：随时触发一次强制打卡
· 独立开关：可单独开启/关闭当前群</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>贺符</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3401118035</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-09 00:27:14</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=154" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">ai猫娘</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: ai_catgirl</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v0.02</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                206 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">ai猫娘 · 人物设定自己调   v0.02

一个能自己设定人物形象的 AI 猫娘，接进 QQ 陪你聊天。

【能做什么】
· 私聊 / 群聊都能聊。群里需要 @ 她才会回应，私聊直接说话就行。
· 人物形象自己调：在菜单「人物形象」里写你想要的名字、性格、口吻、称呼。
· 有自己的性格：默认称呼主人为&amp;quot;主人&amp;quot;，称呼其他人为&amp;quot;客人&amp;quot;。
· 支持多家 AI 服务，填入密钥后自动识别可用模型。
· 每个会话独立记忆，可以随时清空。
· 内置快捷指令：/model 看模型、/status 看状态、/reset 清记忆、/help 看说明。

【怎么用】
1. 打开插件菜单 → 设置，填入 API 密钥，保存后自动识别模型。
2. 在设置里填写允许聊天的好友 QQ 号和群号（白名单）。
3. （可选）打开菜单 → 人物形象，写下你想要的性格与说话风格。
4. 回到聊天窗口发消息即可，她会以你设定的形象回复。

【人物形象怎么调】
· 菜单 → 人物形象，在一个输入框里写整段人设，保存后全部聊天立即生效。
· 可以写：名字、性格、说话口吻、怎么称呼对方、回答多长。
· 留空或点「恢复默认形象」= 回到内置的猫娘小喵。
· 身份判定（谁是主人）和安全底线由程序锁定，不需要也不能在这里改。
· 改完人设会自动清空历史记忆，避免模型顺着旧人格继续说。

【菜单说明】
· 设置          配置密钥、模型、白名单
· 人物形象      自定义她的名字、性格与说话风格
· 总开关        一键开启 / 关闭猫娘
· 清空全部记忆  清掉所有会话的聊天记忆
· 终端日志      查看最近的运行日志，排查&amp;quot;为什么不回&amp;quot;
· 自检          重新检测服务与模型
· 帮助          查看快捷指令

【说明】
· 回复内容由你配置的 AI 服务生成。
· 请自行妥善保管 API 密钥，不要分享给他人。
· 当前版本 v0.02，修复已知 bug，优化界面。
· 问题反馈加QQ：3766604211</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>~主人~</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3766604211</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-08 12:42:35</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=151" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">头像获取</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: get_avatar</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2026.10.08</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                92 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">=========================================
插件名称：头像获取与替换
插件作者：刘雨欣
=========================================

[ 功能简介 ]
本插件支持获取个人或群的高清头像（640x640），并且可以直接将获取到的头像替换为你自己的QQ头像。所有头像均通过官方接口获取，自动下载并发送到当前聊天窗口。

[ 指令说明 ]

一、获取头像
  #头像
    - 获取你自己的高清头像
  #头像 [QQ号]
    - 获取指定 QQ 号的高清头像（例：#头像 10001）
  #群头像
    - 在群聊中发送，获取当前群的高清群头像
  #群头像 [群号]
    - 获取指定群号的高清群头像（例：#群头像 123456）

二、替换头像
  #换头像
    - 把你自己的头像重新替换一次
  #换头像 [QQ号]
    - 把指定 QQ 号的头像变成你自己的（例：#换头像 10001）
  #换群头像
    - 在群聊中发送，把当前群的头像变成你自己的
  #换群头像 [群号]
    - 把指定群的头像变成你自己的（例：#换群头像 123456）

[ 注意事项 ]

1. 风控警告：腾讯对修改头像有极其严格的频率限制。短时间内频繁替换头像极易触发风控，导致头像被锁定甚至账号被限制。请务必谨慎测试，切勿连点。
2. 上传失败：替换失败时，机器人会回复“上传失败，可能被风控或图片格式不支持”，遇到这种情况请等待几个小时后再试。
3. 缓存说明：下载的头像会自动保存在脚本目录下的 cache 文件夹中，不会占用太多空间。
4. 快捷菜单：点击聊天页菜单中的「头像操作说明」可以快速查看当前指令。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-08 01:35:10</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=150" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">群管机器人</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: group_admin_bot</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2026.10.08</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                143 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">群管机器人
作者：刘雨欣

功能简介：
- 入群欢迎、退群通知
- 禁言 / 解禁 / 全员禁言
- 踢人（可拉黑）
- 设置 / 取消管理员（仅群主）
- 修改群名、群打卡、设置头衔
- 查看禁言列表、黑名单、异常用户
- 聊天页菜单「群管帮助」弹窗查看指令

使用说明：
在群聊中发送以 # 开头的指令，例如：
  #禁言 123456 10
  #解禁 123456
  #全员禁言 开
  #踢人 123456 拉黑
  #改群名 新群名
  #群打卡
  #设头衔 123456 头衔
  #禁言列表
  #黑名单
  #异常用户

点击聊天页右上角菜单中的「群管帮助」可查看全部指令。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-08 01:00:22</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=147" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">GitHub|仓库解析</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: js_1791301966533</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v10.7</span>
                                                        <span class="badge" style="background:#f7df1e;color:#333;">JS</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                56 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">GitHub 仓库解析 for QLsu

【触发方式】
· 发送 GitHub 链接
· 发送 gh owner/repo
· 长按消息 → 解析此消息中的 GitHub 仓库

【卡片内容】
· 官方主页图（Social Preview）
· Stars / Forks / Issues
· Languages 语言分布（GitHub 官方配色）
· Latest Release + 下载链接
· Contributors 贡献者（需配置 Token）
· README（优先中文版）

【特色】
· macOS 风格可视化卡片，可滚动查看
· 一键发送完整长截图到群（长内容自动分块）
· 图片格式 JPEG / PNG 可切换
· 多 API 镜像自动 fallback
· 消息去重 + 弹窗去重
· 自己发消息也能触发

【加速】
配置 GitHub Token 后：
· 并行请求，解析速度提升约 5 倍（1-2 秒）
· API 配额从 60 次/小时 → 5000 次/小时

【菜单】
· 设置 GitHub Token
· 设置（各项功能开关 + 图片格式）
· 清理缓存（缓存 / 去重记录 / 截图文件）

脚本目录：QLsu/plugin/github_parser/
截图目录：QLsu/plugin/github_parser/cards/（自动保留最近 40 张）</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>刘雨欣</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3633190269</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-07 12:44:01</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=145" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">针对撤回</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: zhuanchechehui</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                122 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">指定针对别人自动撤回指定人的消息可设置全局或单群生效可添加多个指定目标，
群聊发送针对撤回查看功能。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>呆呆鹅</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>1025671812</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-07 03:58:01</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=143" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">KK键盘同款恶搞语音</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: LengYuPlugins-KKKeyboard</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v7.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                617 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">打死原神玩家

本脚本具有KK键盘同款文字转语音(唱歌模式)

发送文字自动拦截并转成语音发送

菜单设置请长按 &amp;gt;聊天页面&amp;lt; 右上角[三条杠]或者右下角[加号]

*已经添加silk开关和自动转语音开关
*已适配QLsu
*已添加长按消息转语音
*已添加语音模型试听功能
*调试ai翻唱功能</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-06 12:59:10</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=135" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">语音转发</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: 3073261723-3</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                132 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">支持长按语音转发好友群聊，支持本地音频发送，音频放到Android/data/com.tencent.mobileqq/QLsu/音频</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>Q（3073261723）</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3073261723</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-05 13:22:36</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=123" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">已举报你50次😂</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: 3073261723-2</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                135 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">其实这就是一个点赞娱乐的脚本，发送“赞我”即可😋😋😋</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>Q（3073261723）</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3073261723</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-05 11:27:05</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=122" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">index-tts</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: index_tts</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.6</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                88 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">index-tts QLsu 适配版

功能：
1. 长按消息 → “TTS 语音”，选择音色后将文本转换为语音，可先试听生成结果，确认后再发送。
2.增加试听功能，可滑动进度条试听
原作者：嘿佬
QLsu 适配版本：1.6</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>嘿佬</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-05 02:10:37</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=117" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">自动群打卡</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Change_clockIn</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                170 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">加载脚本自动打卡</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>长歌</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3240746990</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-10-05 00:00:01</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=120" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">Online TTS 5.5 QLsu适配版</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: online_tts_55_qedge</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v5.5-qedge2-search</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                182 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">Online TTS 5.5 的 QLsu Java / Modern BeanShell 适配版。

适配内容：
- 使用 QLsu 要求的 main.java + info.prop 目录结构
- 使用 QLsu 提供的 context、pluginPath、getNowActivity、addItem、qqToast、log
- 设置与缓存固定保存在当前插件环境，不再依赖旧宿主 PluginInternalApi
- 保留 TTSModel.getCharacters / performConvert 兼容入口
- 设置与刷新音色可从 QLsu 脚本菜单进入

网络请求按普通客户端方式发送，不包含伪造 IP、随机设备身份或额度绕过逻辑。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>龙之梦(太帅) / QLsu适配</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3362541477</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-27 21:46:18</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=119" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">主题气泡破解</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: theme_crack</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                595 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>YourName</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-27 19:15:32</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=118" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">随机视频</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: video_fenglin_random</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                193 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">🎬 随机视频脚本使用说明

全局总开关：✅ 开启（可通过悬浮窗菜单切换）

📌 可用视频类型（共 22 种）：
随机完美身材  随机怼脸自拍  随机小哥哥视频
随机抖音变装  随机玉足视频  随机黑丝视频
随机白丝视频  随机高质量小姐姐  随机cos视频
随机开心锤锤视频  随机热舞视频  随机蛇姐视频
随机王者荣耀翻唱  随机曼波翻唱  随机陈翔六点半
随机比奇堡翻唱  随机一条穿搭视频  随机一条甜妹视频
小姐姐视频  jk视频  女大视频
女高中生  

.  加了自定义触发

.  增加视频大全，近700个系列

.  添加了视频大全失效系列10天内连续失败3次 → 临时禁用10天 → 10天后自动解禁并重置计数 → 若再次10天内失败3次则永久禁用</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>无法是大笨蛋</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-27 04:54:56</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=115" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">喵娘脚本</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: LengYuPlugins-miaoplugin</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                269 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">喵娘脚本</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-24 13:37:30</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=106" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">文字转图片</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: 3073261723</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                94 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">插件名称：文字转图片
版本号：1.0

【功能简介】
长按聊天消息或输入指令，将文本快速生成为图片并发送。

【主要功能】
1. 长按消息 → 点击&amp;quot;转成图片&amp;quot; → 自动生成并发送
2. 输入指令 &amp;quot;转图 内容&amp;quot; 或 &amp;quot;zt 内容&amp;quot; → 生成图片发送
3. 支持自定义背景色、文字色、字体大小、图片尺寸
4. 开关控制功能启用/停用

【使用方法】
悬浮窗菜单：
- ⚙️ 设置 → 打开设置面板
- 🐛 反馈群 → 加入反馈群

设置面板包含：
- 开关：开启/关闭功能
- 背景色：9种颜色可选
- 文字色：9种颜色可选
- 当前配色：预览当前配色
- 字体大小：小/大
- 图片尺寸：窄(500x150) / 宽(1840x1024)

【文字指令】
- 发送 &amp;quot;设置&amp;quot; → 打开设置面板
- 发送 &amp;quot;反馈群&amp;quot; → 打开反馈群链接
- 发送 &amp;quot;转图 内容&amp;quot; 或 &amp;quot;zt 内容&amp;quot; → 生成图片发送

【注意事项】
- 首次加载后请重启QQ使长按菜单生效
- 开关关闭后长按菜单自动隐藏
- 生成的图片为PNG格式，发送后自动删除缓存

【更新日志】
v1.0
- 初始版本发布
- 支持长按转图、文字指令转图
- 自定义配色、字号、尺寸
- 精美弹窗UI

【联系作者】
QQ：3073261723
反馈群：点击悬浮窗&amp;quot;🐛 反馈群&amp;quot;加入</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>Q</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3073261723</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-19 17:49:31</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=114" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">MC服务器查询</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1789189531532</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.2</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                59 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">MC服务器查询插件
支持多API切换、群权限管理、默认服务器、玩家列表
指令：/mc 地址</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>迷</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-13 18:21:39</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=113" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">MC监测服务器</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1789150863421</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                47 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">MC服务器监测（Java + 基岩版）
自动检测服务器状态、版本、玩家数、延迟、MOTD
支持Java版和基岩版</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>迷</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-12 02:42:57</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=112" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">在线聊天室</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: chatroom_qe_002</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2/0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                123 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">云端聊天室
打开聊天室识别账号
聊天室内可直接识别本人
🤖机器人每小时整点自动报时
消息显示真实发送时间 2分钟内可撤回
点头像进QQ主页</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>Chat BY月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-12 00:33:52</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=101" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">一言外显</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: example_1783915187514</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                88 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">当你发送带有图片的消息时，会自动替换summary为一言</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:49:01</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=111" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">BeanShell 深度测试</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: QLsuDeveloper_BeanShellTest</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                51 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">BeanShell 深度测试脚本
仅支持QLsu 0.0.7版本及以上</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>QLsuDeveloper</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:59</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=110" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">发包工具</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: packetHelper</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                120 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">发包工具</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:57</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=109" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">QLsu多功能工具</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: qedge_common_tool</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                497 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">作者373019917</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>璃光</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:55</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=108" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">消息美化排版</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: LengYuPlugins-facyplugin</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                391 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">消息美化排版</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:53</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=107" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">包体拦截工具</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: QLsu-29421174-187f-4481-88b9-32605752ac27</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v522</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                66 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">拦截QQ请求和接收到的所有protoBuffer，并且转为可读json，部分情况下会有不可见字符，该字段应为hex-&amp;gt;xxxx</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:49</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=105" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">��脚本</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: LengYuPlugins-????plugin</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                38 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">测试</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:47</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=104" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">视频转泡泡消息</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: example_1784300492274</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                85 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">视频转泡泡消息
原始消息体查看</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:41</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=103" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">KK键盘同款恶搞语音</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: LengYuPlugins-KKKeyboard</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v7.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                264 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">打死原神玩家

本脚本具有KK键盘同款文字转语音(唱歌模式)

发送文字自动拦截并转成语音发送

菜单设置请长按 &amp;gt;聊天页面&amp;lt; 右上角[三条杠]或者右下角[加号]

*已经添加silk开关和自动转语音开关
*已适配QLsu
*已添加长按消息转语音</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3470558502</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 22:48:03</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=102" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">在线聊天室</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: chatroom_qe_001</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v4.0.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                74 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">云端聊天室
打开聊天室识别账号
聊天室内可直接识别本人
🤖机器人每小时整点自动报时
消息显示真实发送时间 2分钟内可撤回
点头像进QQ主页

娱乐测试</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>ChatRoom BY月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-10 09:49:05</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=100" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">切换语气多语气版(喵)</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1788788780741</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                166 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">切换语气1.1版本 总词汇共计1080组 删除原版长语气词改简易版
自动识别更新 疑问 感叹 惊讶 自动识别文字适配适合的语气
@神秘大妈 不发了</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>BY月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-09 00:15:32</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=99" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">切换语气多语气版(喵)</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1788788780741</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                57 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">切换语气 自动识别适合位置</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>BY月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-07 22:42:48</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=98" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">QQ拓展小功能</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: 7878</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                233 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">@yueyalz667 神秘大妈
功能
自动回复/自动回赞/关键词回复/定时续火花/及未测试####</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-07 22:42:45</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=97" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">文字转语音</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: plugin_1788712376820</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                178 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">输入文字转语音
女音:唱歌版
男音:朗读版
神秘大妈@yueyalz667</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-07 19:44:08</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=96" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">QQ主页互赞便捷版</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: 679178</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                260 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">(服务器端数据保存)
便捷的互赞服务器 用户登录后会保存数据
更新 降低了风控 优化了卡赞</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>BY月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-07 00:11:13</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=95" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">QQ互赞服务端</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: 679178</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                539 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">登录过的用户数据会保存，可以互相主页互赞
制作不易谢谢</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>BY月牙</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>965391203</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-05 15:32:03</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=94" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">夜鑫神AI</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: yexinshen_ai</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.3</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                127 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">夜鑫神AI每个群单独开关（默认关闭）和单独 API Key，悬浮窗配置，阈值触发、知识库、记忆清除、每日点赞。聊天页打开悬浮窗即可配置
使用的ai平台是元启
https://91yq.top</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>夜鑫神</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>1703535780</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-09-01 19:32:17</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=93" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">赞我</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: star_script</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                290 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">赞我脚本
功能：开启赞我
      关闭赞我</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>繁星</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>1792364161</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-08-25 16:35:24</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=91" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">重新登录检测</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: relogin_detector</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                288 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">═══════════════════════════════════════
   QQ重新登录检测脚本
═══════════════════════════════════════

【功能说明】
检测QQ是否发生重新登录：
• 账号切换（换号登录）
• 同账号重新登录（被踢后重登）
• 被踢下线（异地登录）
• UID变化（重新登录）

【菜单功能】
📊 检测状态 - 查看当前状态
📋 重登日志 - 查看最近20条日志
🗑️ 清理日志 - 清空日志文件
📈 统计报告 - 查看检测统计

【聊天指令】
!状态 / !检测 - 查看当前状态
!日志 - 查看最近10条日志
!统计 - 查看统计信息

【配置说明】
- ADMIN_UIN: 通知接收人（留空则用当前QQ）
- CHECK_INTERVAL: 检测间隔（默认5秒）
- LOG_MAX_LINES: 最大日志条数（默认100条）

【日志位置】
/插件目录/relogin.log

═══════════════════════════════════════</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>YourName</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-08-22 23:17:29</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=90" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">复读你妈</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: fuck_repeat</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                190 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">* 复读检测，检测有没有傻子跟着别人无脑复读
* 可以设置禁言时间
* AI开发，有问题找AI</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2633141805</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-08-11 17:42:19</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=89" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">今日老婆&amp;amp;老公</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: wife_husband_combined</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                286 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">今日老婆 &amp;amp;今日老公 合并插件
群内发送“今日老婆”随机选老婆，发送“今日老公”随机选老公。
离婚指令：离婚 / 休夫
每人每天各限选一次，离婚/休夫每日限3次。
显示头像、昵称、QQ号。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>YourName</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-08-03 15:46:54</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=88" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">今日老婆</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: today_wife_memory</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                183 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">今日老婆插件 (纯内存版)
群内发送&amp;quot;今日老婆&amp;quot;随机选老婆，发送&amp;quot;/离婚&amp;quot;离婚。
支持头像图片、艾特老婆、每日限一次、开关插件。
注意：婚姻数据仅保存在内存中，重启丢失。</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>YourName</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2709025195</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-08-02 14:36:13</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=75" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">视频转泡泡消息</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: example_1784300492274</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                242 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">视频转泡泡消息
原始消息体查看</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>冷雨</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2633141805</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-08-01 11:53:05</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=72" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">等级加速</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Change_LevelQuick</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                1390 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">加载时会有卡顿，等待执行完毕即可</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>长歌</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3355236800</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-29 14:03:38</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=48" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">自动群打卡</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Change_clockIn</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                846 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">加载脚本自动打卡</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>长歌</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3355236800</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-29 13:15:46</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=47" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">命运挑战最终版</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: example_1784869388457</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.3</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                145 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>抚爱</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3556887140</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-25 17:10:46</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=38" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">E2E加密频道</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: qedge_e2e_channel</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v4.1.7</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                99 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>QLsu Community</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>2495362382</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-25 13:59:53</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=37" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">AI插件生成器</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: AI插件生成器</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                192 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>云汐/罗老头</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>104707498</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-25 11:18:35</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=36" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">抚爱拓展菜单</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: entertainment_menu</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                318 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>抚爱</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3556887140</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-24 17:39:32</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=34" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">消息+1</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Change_FuDu</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                281 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>长歌</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3355236800</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-24 13:29:21</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=26" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">自助头衔</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: Change_Self-serviceTitle</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v1.0</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                475 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>长歌</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3355236800</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-24 11:15:04</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=22" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">牛子比拼移植</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: example_1784814943486</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                165 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>抚爱</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3556887140</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-24 00:42:25</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=21" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: var(--color-primary-light); color: var(--color-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                <span class="icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="card-title" style="font-size: 15px;">牛子比拼移植</div>
                                <div style="font-size: 12px; color: var(--color-text-tertiary);">ID: example_1784814943486</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">v2.1</span>
                                                        <span class="badge" style="background:#e8f0fe;color:#1a73e8;">Java</span>
                            <span class="badge badge-success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                165 次下载
                            </span>
                        </div>
                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 10px; padding: 8px 12px; background: var(--color-bg-secondary); border-radius: var(--radius-sm);">该作者很懒，什么也没留下</div>
                                                                        <div style="font-size: 13px; color: var(--color-text-secondary); line-height: 1.8;">
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">作者：</strong>抚爱</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传者：</strong>3556887140</div>
                            <div><strong style="color: var(--color-text-primary); font-weight: 500;">上传时间：</strong>2026-07-24 00:42:25</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="download.php?id=21" class="btn btn-primary btn-sm" style="width: 100%; text-decoration: none;">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </span>
                            下载脚本
                        </a>
                    </div>
                </div>
                            </div>
            </div>

    <script src="../assets/common.js"></script>
    <script>
        function doSearch() {
            var keyword = document.getElementById('searchInput').value.trim();
            if (keyword) {
                window.location.href = 'list.php?search=' + encodeURIComponent(keyword);
            } else {
                window.location.href = 'list.php';
            }
        }

        function clearSearch() {
            window.location.href = 'list.php';
        }

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                doSearch();
            }
        });
    </script>
</body>
</html>
