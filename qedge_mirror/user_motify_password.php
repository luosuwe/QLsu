
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>修改密码 - QLsu 用户中心</title>
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
                        <img src="https://v.yuafeng.cn/uploads/ico/20260810/20260810103148_htmxysnr.png" alt="QLsu">
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
                    <a href="motify_password.php" class="active">
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
                    <a href="sponsor.php" class="">
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
                    <h1 class="topbar-title">修改密码</h1>
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

<div class="page-header">
    <h1 class="page-title">修改密码</h1>
    <p class="page-subtitle">更新您的账户密码</p>
</div>

<div class="card" style="max-width: 500px;">
    <div class="card-body">
        <form id="passwordForm">
            <input type="hidden" name="csrf_token" value="30b5140ee4af716fdb393613444f5d090c86544ab65a1102ca684ffa2a67fa41">

            <div class="form-group">
                <label class="form-label" for="new_password">新密码</label>
                <input type="password" id="new_password" name="new_password" class="form-input" placeholder="请输入新密码（6-32位）" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="confirm_password">确认密码</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-input" placeholder="请再次输入新密码" required>
            </div>

            <div class="form-group">
                <button type="submit" id="submitBtn" class="btn btn-primary btn-block">修改密码</button>
            </div>
        </form>

        <div class="alert alert-primary" style="margin-top: 16px; margin-bottom: 0;">
            <span class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </span>
            <span>修改密码后，请使用新密码重新登录系统。</span>
        </div>
    </div>
</div>

<script>
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.textContent = '修改中...';
        const formData = new FormData(this);
        fetch('../api/user/change_password.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.code === 200) {
                Toast.success(data.message);
                setTimeout(() => window.location.href = 'logout.php', 2000);
            } else {
                Toast.error(data.message);
                submitBtn.disabled = false;
                submitBtn.textContent = '修改密码';
            }
        })
        .catch(() => {
            Toast.error('网络错误，请稍后重试');
            submitBtn.disabled = false;
            submitBtn.textContent = '修改密码';
        });
    });
</script>

            </main>
        </div>
    </div>
    <script src="../assets/common.js"></script>
</body>
</html>
