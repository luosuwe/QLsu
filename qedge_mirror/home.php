<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>QLsu - Xposed 模块简介</title>
    <meta name="description" content="基于XPosed的多功能模块，作用于QQ,TIM,KK键盘,傲软抠图,酷狗,无痛单词,一个木函,设备信息X等应用" />
    <meta name="keywords" content="冷雨,QQ模块,Xposed模块,QLsu,免费模块,LengYu" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="https://v.yuafeng.cn/uploads/ico/20260810/20260810103148_htmxysnr.png">
    <link rel="stylesheet" href="assets/style.css?v=1793253719">
    <style>
        /* ===== 首页专属：仅补充 style.css 未覆盖的部分 ===== */
        .home-title-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 4px;
        }
        .home-title-row .page-title { margin-bottom: 0; }

        /* 功能卡片 */
        .feat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }
        .feat-item {
            padding: 16px;
            border: 1px solid var(--color-border-light);
            border-radius: var(--radius-lg);
            background: var(--color-bg-secondary);
            transition: var(--transition);
        }
        .feat-item:hover {
            border-color: var(--color-border);
            box-shadow: var(--shadow-sm);
            transform: translateY(-2px);
        }
        .feat-item .stat-icon { margin-bottom: 12px; }
        .feat-item h3 {
            font-size: 15px;
            font-weight: 600;
            color: var(--color-text-primary);
            margin-bottom: 6px;
        }
        .feat-item p {
            font-size: 13px;
            color: var(--color-text-secondary);
            line-height: 1.7;
            margin: 0;
        }

        .home-footer {
            text-align: center;
            padding: 8px 0 32px;
            color: var(--color-text-tertiary);
            font-size: 13px;
        }
        .home-footer p + p { margin-top: 6px; }

        /* ===== 广告位（第一个卡片，多条广告自动轮播 + 手势左右滑动） ===== */
        .ad-card {
            position: relative;
            margin-bottom: 24px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: var(--color-bg-secondary);
            touch-action: pan-y;
        }
        .ad-track {
            display: flex;
            transition: transform 0.55s cubic-bezier(0.22, 0.61, 0.36, 1);
            will-change: transform;
        }
        .ad-slide {
            position: relative;
            display: block;
            flex: 0 0 100%;
            text-decoration: none;
        }
        .ad-slide img {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            background: var(--color-bg-secondary);
            pointer-events: none;
        }
        .ad-cap {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 12px 14px;
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));
        }
        .ad-tag {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 11px;
            color: #fff;
            background: rgba(0, 0, 0, 0.35);
        }

        a.inline-link {
            color: var(--color-primary);
            text-decoration: none;
        }
        a.inline-link:hover { text-decoration: underline; }

        /* ===== 顶栏防换行：标题超长省略，右侧入口不压缩 ===== */
        .topbar-left {
            min-width: 0;
            flex: 1;
        }
        .topbar-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .topbar-right {
            flex-shrink: 0;
        }

        /* ===== 手机端适配 ===== */
        @media (max-width: 640px) {
            /* 顶栏右侧入口在侧边栏中已有，小屏隐藏避免挤压标题 */
            .topbar-right {
                display: none;
            }
            /* 功能卡片改单栏，避免 320px 小屏横向溢出 */
            .feat-grid {
                grid-template-columns: 1fr;
            }
            .home-footer {
                padding-bottom: 24px;
            }
        }
        @media (max-width: 480px) {
            .card-footer {
                flex-direction: column;
                align-items: stretch !important;
            }
            .card-footer .btn {
                width: 100%;
                justify-content: center;
            }
        }
        /* 侧边栏品牌图标改用站点 logo（替换原 SVG）：去掉渐变底色，完整显示 logo */
        .sidebar-brand .brand-icon {
            background: none;
            border-radius: 0;
            overflow: hidden;
        }
        .sidebar-brand .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
    </style>
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="index.php" class="sidebar-brand">
                <span class="brand-icon">
                    <img src="https://v.yuafeng.cn/uploads/ico/20260810/20260810103148_htmxysnr.png" alt="QLsu">
                </span>
                <span>QLsu</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-nav-section">
                <div class="sidebar-nav-label">站点导航</div>
                <a href="index.php" class="active">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span>首页</span>
                </a>
                <a href="online_plugin/list.php">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </span>
                    <span>在线脚本</span>
                </a>
                <a href="user/login.php">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span>用户中心</span>
                </a>
            </div>
            <div class="sidebar-nav-section">
                <div class="sidebar-nav-label">资源下载</div>
                <a href="https://cdn.yuafeng.cn/ly/QLsu_0.3.8.apk" target="_blank" rel="noopener">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </span>
                    <span>下载模块</span>
                </a>
                <a href="update/doc.php">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                    </span>
                    <span>更新日志</span>
                </a>
                <a href="/PluginMethod/" target="_blank" rel="noopener">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </span>
                    <span>开发文档</span>
                </a>
                <a href="https://github.com/LengYu-cr/QLsu-main/" target="_blank" rel="noopener">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                            <path d="M9 18c-4.51 2-5-2-7-2"></path>
                        </svg>
                    </span>
                    <span>GitHub 开源</span>
                </a>
            </div>
        </nav>
    </aside>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-content">
        <header class="topbar">
            <div class="topbar-left">
                <button class="topbar-menu-btn" id="menuBtn" aria-label="菜单">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="topbar-title">QLsu 首页</h1>
            </div>
            <div class="topbar-right">
                <a href="update/doc.php" class="topbar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="13 2 13 9 20 9"></polyline>
                    </svg>
                    <span>更新日志</span>
                </a>
                <a href="https://cdn.yuafeng.cn/ly/QLsu_0.3.8.apk" target="_blank" rel="noopener" class="topbar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>下载模块</span>
                </a>
            </div>
        </header>

        <main class="page-content">
            <div class="page-header">
                <div class="home-title-row">
                    <h1 class="page-title">QLsu</h1>
                    <span class="badge badge-primary">v0.3.8</span>
                </div>
                <p class="page-subtitle">基于XPosed的多功能模块，作用于QQ,TIM,KK键盘,傲软抠图,酷狗,无痛单词,一个木函,设备信息X等应用</p>
            </div>

                                    <div class="ad-card" id="adCard" data-total="4">
                <div class="ad-track" id="adTrack">
                                        <a class="ad-slide" href="https://github.com/LengYu-cr/QLsu-main" target="_blank" rel="noopener nofollow">
                        <img src="https://cdn.yuafeng.cn/img/jb.png" alt="QLsu模块开源仓" loading="lazy">
                        <span class="ad-cap">QLsu模块开源仓</span>
                    </a>
                                        <a class="ad-slide" href="https://user.lucdn.cn/?aff=S491J7" target="_blank" rel="noopener nofollow">
                        <img src="https://api-v2.yuafeng.cn/assets/images/gg/gg8.png" alt="语录云" loading="lazy">
                        <span class="ad-cap">语录云</span>
                    </a>
                                        <a class="ad-slide" href="https://v.yuafeng.cn" target="_blank" rel="noopener nofollow">
                        <img src="https://sfile.chatglm.cn/chatglm4/b247b66d-5d06-4934-ad8a-b3b3579d8ad7.jpg" alt="冷雨API-免费稳定" loading="lazy">
                        <span class="ad-cap">冷雨API-免费稳定</span>
                    </a>
                                        <a class="ad-slide" href="https://cloud.dinduan.com/aff/MNAXRDDW" target="_blank" rel="noopener nofollow">
                        <img src="https://api-v2.yuafeng.cn/assets/images/gg/gg4.png" alt="顶端云-全球服务商" loading="lazy">
                        <span class="ad-cap">顶端云-全球服务商</span>
                    </a>
                                                            <!-- 末尾克隆第一张：保证轮播到末尾时动画方向依旧是「从右向左」 -->
                    <a class="ad-slide" href="https://github.com/LengYu-cr/QLsu-main" target="_blank" rel="noopener nofollow" aria-hidden="true" tabindex="-1">
                        <img src="https://cdn.yuafeng.cn/img/jb.png" alt="" loading="lazy">
                        <span class="ad-cap">QLsu模块开源仓</span>
                    </a>
                                    </div>
                <span class="ad-tag">广告</span>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">当前版本</span>
                        <div class="stat-icon primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">v0.3.8</div>
                    <div class="stat-label"><a class="inline-link" href="https://cdn.yuafeng.cn/ly/QLsu_0.3.8.apk" target="_blank" rel="noopener">点击下载模块 APK</a></div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">更多功能</span>
                        <div class="stat-icon success">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">请下载体验</div>
                    <div class="stat-label"><a class="inline-link" href="https://cdn.yuafeng.cn/ly/QLsu_0.3.8.apk" target="_blank" rel="noopener">更多功能请下载模块查看</a></div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">在线脚本</span>
                        <div class="stat-icon purple">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">Java / JavaScript</div>
                    <div class="stat-label"><a class="inline-link" href="online_plugin/list.php">进入脚本库</a></div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">开发文档</span>
                        <div class="stat-icon warning">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">脚本 API</div>
                    <div class="stat-label"><a class="inline-link" href="/PluginMethod/" target="_blank" rel="noopener">打开开发文档</a></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">功能特性</h2>
                </div>
                <div class="card-body">
                    <div class="feat-grid">
                                                <div class="feat-item">
                            <div class="stat-icon primary">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><circle cx="12" cy="7" r="4"></circle><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path></svg>
                            </div>
                            <h3>用户体系</h3>
                            <p>注册、登录、资料管理一应俱全，赞助用户可自定义个性签名等专属特权。</p>
                        </div>
                                                <div class="feat-item">
                            <div class="stat-icon success">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </div>
                            <h3>在线脚本</h3>
                            <p>一键上传、下载与管理脚本，支持 Java / JS 双引擎，自动统计下载次数。</p>
                        </div>
                                                <div class="feat-item">
                            <div class="stat-icon purple">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                            </div>
                            <h3>数据统计</h3>
                            <p>实时汇总注册量、在线人数、脚本下载等关键指标，运营数据一目了然。</p>
                        </div>
                                                <div class="feat-item">
                            <div class="stat-icon danger">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            </div>
                            <h3>心跳机制</h3>
                            <p>统计用户数量和版本号，方便反馈bug时针对性处理</p>
                        </div>
                                            </div>
                </div>
                <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <span style="font-size: 13px; color: var(--color-text-tertiary);">更多功能请下载模块自行查看</span>
                    <a href="https://cdn.yuafeng.cn/ly/QLsu_0.3.8.apk" target="_blank" rel="noopener" class="btn btn-primary">下载 v0.3.8</a>
                </div>
            </div>

            <footer class="home-footer">
                <p>&copy; 2026 QLsu System. All rights reserved.</p>
                <p>作者：lengyu · <a class="inline-link" href="https://github.com/LengYu-cr/QLsu-main/" target="_blank" rel="noopener">GitHub 开源地址</a></p>
            </footer>
        </main>
    </div>
</div>
<script src="assets/common.js?v=1792336012"></script>
<script>
    /* 首页广告位：多条广告每 3 秒从右向左轮播一张，并支持手势左右滑动；只有一条时不轮播、不可滑动 */
    (function () {
        var card = document.getElementById('adCard');
        var track = document.getElementById('adTrack');
        if (!card || !track) return;

        var total = parseInt(card.getAttribute('data-total'), 10) || 1;
        if (total <= 1) return;

        var index = 0;          // 当前显示的下标（可能等于 total，表示停在克隆位上）
        var timer = null;
        var dragging = false;
        var moved = false;
        var startX = 0;
        var startY = 0;
        var dx = 0;

        function width() {
            return card.clientWidth;
        }

        function offsetOf(i) {
            return -i * width();
        }

        function render(i) {
            track.style.transform = 'translateX(' + offsetOf(i) + 'px)';
        }

        // 无动画归位（用于克隆位瞬移回第一张）
        function snapTo(i) {
            track.style.transition = 'none';
            var next = i;
            render(next);
            track.offsetWidth; // 强制回流，确保「关闭过渡」这一步先生效
            requestAnimationFrame(function () {
                track.style.transition = '';
            });
            index = next;
        }

        function next() {
            if (index >= total) return; // 正在处理克隆位，跳过这一次
            index++;
            render(index);
        }

        function prev() {
            if (index <= 0) {
                render(0);
                return;
            }
            index--;
            render(index);
        }

        // 走到末尾克隆位后，动画结束瞬移回第一张（视觉上无感）
        track.addEventListener('transitionend', function (e) {
            if (e.target !== track) return;
            if (index >= total) {
                snapTo(0);
            }
        });

        function schedule() {
            clearTimeout(timer);
            timer = setTimeout(function () {
                next();
                schedule();
            }, 3000);
        }

        // ===== 手势滑动 =====
        card.addEventListener('pointerdown', function (e) {
            if (e.pointerType === 'mouse' && e.button !== 0) return;
            dragging = true;
            moved = false;
            dx = 0;
            startX = e.clientX;
            startY = e.clientY;
            clearTimeout(timer);
            track.style.transition = 'none';
        });

        card.addEventListener('pointermove', function (e) {
            if (!dragging) return;
            var mx = e.clientX - startX;
            var my = e.clientY - startY;

            if (!moved) {
                if (Math.abs(mx) < 8) return;                    // 位移太小，先不判定
                if (Math.abs(my) > Math.abs(mx)) {               // 纵向滑动交给页面滚动
                    dragging = false;
                    track.style.transition = '';
                    render(index);
                    schedule();
                    return;
                }
            }

            moved = true;
            dx = mx;
            track.style.transform = 'translateX(' + (offsetOf(index) + dx) + 'px)';
        });

        function endDrag() {
            if (!dragging) return;
            dragging = false;
            track.style.transition = '';

            if (moved && Math.abs(dx) > width() * 0.2) {
                if (dx < 0) {
                    next();
                } else {
                    prev();
                }
            } else {
                render(index);
            }

            dx = 0;
            schedule();
        }

        card.addEventListener('pointerup', endDrag);
        card.addEventListener('pointercancel', endDrag);

        // 拖动后松手不要触发广告跳转
        card.addEventListener('click', function (e) {
            if (moved) {
                e.preventDefault();
                e.stopPropagation();
                moved = false;
            }
        }, true);

        // 避免图片被浏览器原生拖拽打断手势
        card.addEventListener('dragstart', function (e) {
            e.preventDefault();
        });

        // 窗口尺寸变化后按新宽度重新对齐
        window.addEventListener('resize', function () {
            track.style.transition = 'none';
            render(index);
            track.offsetWidth;
            requestAnimationFrame(function () {
                track.style.transition = '';
            });
        });

        // 页面切到后台时暂停轮播
        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                clearTimeout(timer);
            } else {
                schedule();
            }
        });

        // 首次进入随机挑一条开始展示，避免每次都固定从同一条（最新上架的）开始
        index = Math.floor(Math.random() * total);
        render(index);
        schedule();
    })();
</script>
</body>
</html>
