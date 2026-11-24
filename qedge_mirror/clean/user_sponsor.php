
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>赞助作者 - QLsu 用户中心</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
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
                <a href="../index.php" class="sidebar-brand">
                    <span class="brand-icon">
                        <img src="/icon.png" alt="QLsu">
                    </span>
                    <span>QLsu 用户中心</span>
                </a>
            </div>

                        <div style="padding: 14px 16px; border-bottom: 1px solid var(--color-border); display:flex; align-items:center; gap:10px;">
                <img src="https://q1.qlogo.cn/g?b=qq&nk=3498573556&s=640" alt="avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:1px solid var(--color-border);">
                <div style="min-width:0; flex:1;">
                    <div style="font-size:14px;font-weight:600;color:var(--color-text-primary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        洛洛                    </div>
                    <div style="font-size:12px;color:var(--color-text-tertiary);margin-top:2px;">
                        QQ: 3498573556                    </div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="sidebar-nav-section">
                    <div class="sidebar-nav-label">账户中心</div>
                    <a href="index.php" class="">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <span>用户主页</span>
                    </a>
                    <a href="motify_password.php" class="">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <span>修改密码</span>
                    </a>
                    <a href="feedback.php" class="">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </span>
                        <span>反馈中心</span>
                    </a>
                </div>
                                <div class="sidebar-nav-section">
                    <div class="sidebar-nav-label">脚本上传</div>
                    <a href="upload.php" class="">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </span>
                        <span>上传脚本</span>
                    </a>
                </div>
                                                <div class="sidebar-nav-section">
                    <div class="sidebar-nav-label">审核权限</div>
                    <a href="plugin_review.php" class="">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </span>
                        <span>脚本审核</span>
                    </a>
                </div>
                                                <div class="sidebar-nav-section">
                    <div class="sidebar-nav-label">其他</div>
                    <a href="sponsor.php" class="active">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </span>
                        <span>赞助作者</span>
                    </a>
                    <a href="../online_plugin/list.php">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                        </span>
                        <span>在线脚本</span>
                    </a>
                    <a href="../index.php">
                        <span class="icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </span>
                        <span>返回首页</span>
                    </a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <a href="logout.php">
                    <span class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </span>
                    <span>退出登录</span>
                </a>
            </div>
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
                    <h1 class="topbar-title">赞助作者</h1>
                </div>
                <div class="topbar-right">
                    <a href="../index.php" class="topbar-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        </svg>
                        <span>首页</span>
                    </a>
                </div>
            </header>
            <main class="page-content">


<div class="card" style="max-width: 720px;">
    <div class="card-header">
        <h3 class="card-title">赞助作者</h3>
        <p class="card-subtitle" style="margin-top:4px;">感谢您对 QLsu 项目的支持，每一笔赞助都是我们持续更新的动力</p>
    </div>
    <div class="card-body">
        <div style="display:flex; flex-direction:column; align-items:center; gap: 16px; padding: 20px 0;">
            <div style="
                width: 100%;
                max-width: 320px;
                aspect-ratio: 1 / 1;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 4px 24px rgba(100, 150, 200, 0.15);
                border: 1px solid var(--color-border);
                background: #fff;">
                <img
                    src="/icon.png"
                    alt="微信收款码"
                    style="width:100%; height:100%; object-fit:cover; display:block;"
                    onerror="this.parentNode.innerHTML='<div style=\'padding:40px;text-align:center;color:var(--color-text-secondary);\'>收款码图片加载失败<br>请访问 <a href=\'https://cdn.yuafeng.cn/ly/wx.png\' style=\'color:var(--color-primary);\'>https://cdn.yuafeng.cn/ly/wx.png</a></div>'"
                >
            </div>
            <div style="text-align:center; line-height:1.8; color: var(--color-text-secondary); font-size: 14px;">
                <div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14" style="vertical-align:-2px; color:#07c160;">
                        <path d="M9 11l3 3L22 4"></path>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    &nbsp;微信扫码 / 长按识别 任意金额
                </div>
                <div style="margin-top:6px;">您的支持会出现在 <a href="../index.php#sponsor-wall" style="color:var(--color-primary);">首页赞助墙</a>（如需匿名请在付款时备注）</div>
            </div>
        </div>
    </div>
</div>

            </main>
        </div>
    </div>
    <script src="../assets/common.js"></script>
</body>
</html>
