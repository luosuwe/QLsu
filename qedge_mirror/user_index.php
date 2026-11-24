
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>用户首页 - QLsu 用户中心</title>
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
                    <a href="index.php" class="active">
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
                    <h1 class="topbar-title">用户首页</h1>
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
    <h1 class="page-title">个人中心</h1>
    <p class="page-subtitle">管理您的账户信息</p>
</div>

<div class="card" style="margin-bottom: 16px;">
    <div class="card-body">
        <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="position: relative; display: inline-block;">
                <img src="https://q1.qlogo.cn/g?b=qq&nk=3498573556&s=640" alt="头像" class="user-avatar" style="width: 64px; height: 64px; display: block;">
                            </div>
            <div style="flex: 1;">
                <h2 style="font-size: 18px; font-weight: 600; color: var(--color-text-primary); margin-bottom: 4px;">洛洛</h2>
                <p style="font-size: 14px; color: var(--color-text-secondary);">QQ: 3498573556</p>
            </div>
        </div>
        <div style="display: flex; gap: 8px; margin-top: 16px; flex-wrap: wrap;">
                            <span class="badge badge-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    上传权限
                </span>
                                        <span class="badge badge-purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    审核权限
                </span>
                    </div>
    </div>
</div>

<div class="card" style="margin-bottom: 16px;">
    <div class="card-header">
        <h3 class="card-title">账户信息</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px 24px; font-size: 14px;">
            <div>
                <span style="color: var(--color-text-tertiary);">注册时间：</span>
                <span style="color: var(--color-text-primary);">2026-11-02 12:48:04</span>
            </div>
            <div>
                <span style="color: var(--color-text-tertiary);">最后登录：</span>
                <span style="color: var(--color-text-primary);">2026-11-24 20:56:01</span>
            </div>
            <div>
                <span style="color: var(--color-text-tertiary);">模块版本：</span>
                <span style="color: var(--color-text-primary);">0.3.6</span>
            </div>
            <div>
                <span style="color: var(--color-text-tertiary);">QQ版本：</span>
                <span style="color: var(--color-text-primary);">9.3.70</span>
            </div>
        </div>
        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--color-border-light);">
            <div style="font-size: 14px; color: var(--color-text-tertiary); margin-bottom: 8px;">个性签名</div>
            <div style="font-size: 14px; color: var(--color-text-primary); line-height: 1.6;">
                暂无签名            </div>
        </div>
    </div>
</div>




<div class="card" style="margin-bottom: 16px;">
    <div class="card-header">
        <h3 class="card-title">修改昵称</h3>
    </div>
    <div class="card-body">
        <form id="nicknameForm">
            <div class="form-group">
                <label class="form-label">新昵称</label>
                <input type="text" id="nickname" name="nickname" class="form-input" placeholder="请输入新昵称（最多20个字符）" maxlength="20" value="洛洛">
            </div>
            <button type="submit" class="btn btn-primary" id="saveNicknameBtn">保存昵称</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">快捷操作</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px;">
            <a href="../online_plugin/list.php" class="btn btn-secondary" style="justify-content: flex-start; text-decoration: none;">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                </span>
                在线脚本
            </a>
                        <a href="plugin_review.php" class="btn btn-secondary" style="justify-content: flex-start; text-decoration: none;">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </span>
                脚本审核
            </a>
                        <a href="motify_password.php" class="btn btn-secondary" style="justify-content: flex-start; text-decoration: none;">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </span>
                修改密码
            </a>
            <a href="feedback.php" class="btn btn-secondary" style="justify-content: flex-start; text-decoration: none;">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </span>
                反馈中心
            </a>
        </div>
    </div>
</div>

<script>

document.getElementById('nicknameForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const nickname = document.getElementById('nickname').value.trim();
    const btn = document.getElementById('saveNicknameBtn');
    
    if (!nickname) {
        Toast.error('昵称不能为空');
        return;
    }
    
    btn.disabled = true;
    btn.textContent = '保存中...';
    
    fetch('../api/user/update_nickname.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nickname: nickname, csrf_token: '30b5140ee4af716fdb393613444f5d090c86544ab65a1102ca684ffa2a67fa41' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.code === 200) {
            Toast.success('昵称修改成功！');
            setTimeout(() => location.reload(), 1000);
        } else {
            Toast.error(data.message);
        }
    })
    .catch(() => {
        Toast.error('网络错误，请稍后重试');
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = '保存昵称';
    });
});

</script>

            </main>
        </div>
    </div>
    <script src="../assets/common.js"></script>
</body>
</html>
