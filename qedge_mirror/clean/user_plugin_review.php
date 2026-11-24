
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>脚本审核 - QLsu 用户中心</title>
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
                    <a href="plugin_review.php" class="active">
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
                    <h1 class="topbar-title">脚本审核</h1>
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
    <h1 class="page-title">脚本审核</h1>
    <p class="page-subtitle">共 89 个脚本</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-label">总计</span>
            <div class="stat-icon primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
            </div>
        </div>
        <div class="stat-value">89</div>
        <div class="stat-label">脚本总数</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-label">待审核</span>
            <div class="stat-icon warning">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                    <circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
        </div>
        <div class="stat-value" style="color: var(--color-warning);">0</div>
        <div class="stat-label">待审核脚本</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-label">已通过</span>
            <div class="stat-icon success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
        </div>
        <div class="stat-value" style="color: var(--color-success);">81</div>
        <div class="stat-label">已通过审核</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-label">已拒绝</span>
            <div class="stat-icon danger">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                    <circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </div>
        </div>
        <div class="stat-value" style="color: var(--color-danger);">7</div>
        <div class="stat-label">已拒绝脚本</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-label">已下架</span>
            <div class="stat-icon" style="background: #f5f5f5; color: #595959;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline>
                </svg>
            </div>
        </div>
        <div class="stat-value" style="color: #595959;">1</div>
        <div class="stat-label">已下架脚本</div>
    </div>
</div>

<div class="filter-bar">
    <button class="filter-btn active" onclick="location.href='plugin_review.php?status=0'">待审核</button>
    <button class="filter-btn " onclick="location.href='plugin_review.php?status=1'">已通过</button>
    <button class="filter-btn " onclick="location.href='plugin_review.php?status=2'">已拒绝</button>
    <button class="filter-btn " onclick="location.href='plugin_review.php?status=3'">已下架</button>
    <button class="filter-btn " onclick="location.href='plugin_review.php?status=-1'">全部</button>
</div>

<!-- Zip Preview Modal -->
<div class="modal-overlay" id="previewModalOverlay" style="display:none;">
    <div class="modal" style="max-width: 650px;">
        <div class="modal-header">
            <h3 class="modal-title" id="previewTitle">文件预览</h3>
            <button class="modal-close" onclick="closePreviewModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                    <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body" id="previewContent" style="padding:16px;">
            <div style="text-align:center;padding:30px;color:#999;">加载中...</div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal-overlay" id="rejectModalOverlay" style="display:none;">
    <div class="modal" style="max-width: 520px;">
        <div class="modal-header">
            <h3 class="modal-title">拒绝原因</h3>
            <button class="modal-close" onclick="closeRejectModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                    <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="padding: 16px 20px;">
            <textarea id="rejectReason" class="form-textarea" placeholder="请输入拒绝原因（必填，最多500字）" maxlength="500" style="width:100%;min-height:120px;"></textarea>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeRejectModal()">取消</button>
            <button class="btn btn-primary" onclick="confirmReject()">确认拒绝</button>
        </div>
    </div>
</div>

    <div class="card">
        <div class="card-body">
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="empty-state-icon">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
                <h3>暂无相关脚本</h3>
                <p>当前筛选条件下没有脚本</p>
            </div>
        </div>
    </div>

<script src="../assets/ai_review.js"></script>
<script>
    var csrfToken = '30b5140ee4af716fdb393613444f5d090c86544ab65a1102ca684ffa2a67fa41';
    var currentRejectId = null;
    var previewExts = ['java', 'js', 'json', 'prop', 'txt'];

    // 脚本卡片：默认收起，点击卡片头部展开/收起
    function toggleReviewCard(btn) {
        var card = btn.closest('.plugin-review-card');
        if (!card) return;
        var opened = card.classList.toggle('open');
        btn.setAttribute('aria-expanded', opened ? 'true' : 'false');
    }

    function approvePlugin(id) {
        Modal.confirm('确认通过该脚本？', function() { submitAction(id, 'approve'); });
    }

    function takedownPlugin(id) {
        Modal.confirm('确认下架该脚本？下架后用户将无法下载。', function() { submitAction(id, 'takedown'); });
    }

    function submitAction(id, action, extra) {
        Loading.show();
        var body = 'action=' + action + '&could_id=' + id + '&csrf_token=' + csrfToken;
        if (extra) body += '&' + extra;
        fetch('../api/user/plugin_review.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: body
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            Loading.hide();
            if (data.code === 200) {
                Toast.success(data.message);
                setTimeout(function() { location.reload(); }, 1000);
            } else {
                Toast.error(data.message);
            }
        })
        .catch(function() {
            Loading.hide();
            Toast.error('操作失败，请稍后重试');
        });
    }

    function rejectPlugin(id) {
        currentRejectId = id;
        document.getElementById('rejectReason').value = '';
        document.getElementById('rejectModalOverlay').style.display = 'flex';
    }

    function closeRejectModal() {
        document.getElementById('rejectModalOverlay').style.display = 'none';
        currentRejectId = null;
    }

    function confirmReject() {
        var reason = document.getElementById('rejectReason').value.trim();
        if (!reason) { Toast.error('请输入拒绝原因'); return; }
        submitAction(currentRejectId, 'reject', 'reason=' + encodeURIComponent(reason));
        closeRejectModal();
    }

    function previewZip(couldId, pluginName) {
        document.getElementById('previewTitle').textContent = pluginName + ' - 文件预览';
        document.getElementById('previewContent').innerHTML = '<div style="text-align:center;padding:30px;color:#999;">加载中...</div>';
        document.getElementById('previewModalOverlay').style.display = 'flex';

        fetch('../api/user/zip_preview.php?could_id=' + couldId)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.code !== 200) {
                document.getElementById('previewContent').innerHTML = '<div style="text-align:center;padding:30px;color:#999;">' + (data.message || '预览失败') + '</div>';
                return;
            }
            var files = data.data.files;
            if (!files || files.length === 0) {
                document.getElementById('previewContent').innerHTML = '<div style="text-align:center;padding:30px;color:#999;">压缩包为空</div>';
                return;
            }
            var style = '<style>.zip-tree{font-family:Consolas,Monaco,monospace;font-size:13px;line-height:1.8;background:#fafafa;border:1px solid #e8e8e8;border-radius:4px;padding:14px;max-height:400px;overflow-y:auto}.zip-tree .file-item{display:flex;align-items:center;gap:6px;padding:1px 0}.zip-tree .file-icon{flex-shrink:0;width:16px;text-align:center;font-size:12px}.zip-tree .file-name{color:#333;word-break:break-all}.zip-tree .file-name.previewable{color:#1a73e8;cursor:pointer;text-decoration:underline}.zip-tree .file-size{color:#999;font-size:12px;margin-left:auto;white-space:nowrap}.zip-tree .dir-icon{color:#d4880f}.zip-tree .file-icon-doc{color:#1a73e8}.zip-tree .indent{display:inline-block}</style>';
            var html = style + '<div class="zip-tree">';
            html += '<div style="margin-bottom:8px;color:#999;font-size:12px;">共 ' + data.data.total_files + ' 个条目</div>';
            for (var i = 0; i < files.length; i++) {
                var f = files[i];
                var parts = f.name.split('/');
                var indent = Math.max(0, parts.length - 1);
                var displayName = parts[parts.length - 1] || parts[parts.length - 2] || f.name;
                var pad = (indent * 20) + 'px';
                var ext = displayName.split('.').pop().toLowerCase();
                var canPreview = !f.is_dir && previewExts.indexOf(ext) >= 0;

                if (f.is_dir) {
                    html += '<div class="file-item"><span class="indent" style="width:' + pad + '"></span><span class="file-icon dir-icon">D</span><span class="file-name" style="font-weight:500;">' + escapeHtml(displayName) + '/</span></div>';
                } else {
                    var sizeStr = formatSize(f.size);
                    if (canPreview) {
                        html += '<div class="file-item"><span class="indent" style="width:' + pad + '"></span><span class="file-icon file-icon-doc">F</span><span class="file-name previewable" onclick="openFilePreview(' + couldId + ', \'' + escapeAttr(f.name) + '\')">' + escapeHtml(displayName) + '</span><span class="file-size">' + sizeStr + '</span></div>';
                    } else {
                        html += '<div class="file-item"><span class="indent" style="width:' + pad + '"></span><span class="file-icon file-icon-doc">F</span><span class="file-name">' + escapeHtml(displayName) + '</span><span class="file-size">' + sizeStr + '</span></div>';
                    }
                }
            }
            html += '</div>';
            document.getElementById('previewContent').innerHTML = html;
        })
        .catch(function() {
            document.getElementById('previewContent').innerHTML = '<div style="text-align:center;padding:30px;color:#999;">请求失败</div>';
        });
    }

    function openFilePreview(couldId, fileName) {
        window.open('../online_plugin/preview.php?could_id=' + couldId + '&file=' + encodeURIComponent(fileName), '_blank');
    }

    function closePreviewModal() {
        document.getElementById('previewModalOverlay').style.display = 'none';
    }

    function downloadPlugin(couldId) {
        window.open('../api/user/plugin_download.php?could_id=' + couldId, '_blank');
    }

    function formatSize(bytes) {
        if (bytes === 0) return '0 B';
        var k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        return (bytes / Math.pow(k, i)).toFixed(1) + ' ' + sizes[i];
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    function escapeAttr(str) {
        return str.replace(/\\/g, '/').replace(/'/g, "\\'").replace(/"/g, '&quot;');
    }

    document.getElementById('previewModalOverlay').addEventListener('click', function(e) { if (e.target === this) closePreviewModal(); });
    document.getElementById('rejectModalOverlay').addEventListener('click', function(e) { if (e.target === this) closeRejectModal(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closePreviewModal(); closeRejectModal(); } });
</script>

            </main>
        </div>
    </div>
    <script src="../assets/common.js"></script>
</body>
</html>
