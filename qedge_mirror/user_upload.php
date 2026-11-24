
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>脚本上传 - QLsu 用户中心</title>
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
                    <a href="upload.php" class="active">
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
                    <h1 class="topbar-title">脚本上传</h1>
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

<style>
    .up-wrapper { max-width: 860px; margin: 0 auto; }
    .up-drop {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 34px 20px;
        border: 1.5px dashed var(--color-border);
        border-radius: var(--radius-lg);
        background: var(--color-bg-secondary);
        cursor: pointer;
        text-align: center;
        transition: var(--transition);
    }
    .up-drop:hover, .up-drop.dragover {
        border-color: var(--color-primary);
        background: var(--color-primary-light);
    }
    .up-drop .icon { color: var(--color-text-tertiary); display: flex; }
    .up-drop-title { font-size: 14px; font-weight: 550; color: var(--color-text-primary); word-break: break-all; line-height: 1.5; }
    .up-drop-hint { font-size: 12px; color: var(--color-text-tertiary); line-height: 1.65; }
    .up-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 14px; }
    .up-msg { font-size: 13px; color: var(--color-text-tertiary); word-break: break-all; line-height: 1.5; }
    .up-msg.error { color: var(--color-danger); }
    .up-meta { border: 1px solid var(--color-border-light); border-radius: var(--radius-lg); overflow: hidden; }
    .up-meta-row { display: flex; gap: 12px; padding: 10px 14px; font-size: 13px; border-bottom: 1px solid var(--color-border-light); }
    .up-meta-row:last-child { border-bottom: none; }
    .up-meta-row .k { width: 76px; flex-shrink: 0; color: var(--color-text-tertiary); }
    .up-meta-row .v { flex: 1; min-width: 0; color: var(--color-text-primary); word-break: break-word; white-space: pre-wrap; }
    .up-empty { padding: 34px 20px; text-align: center; font-size: 14px; color: var(--color-text-tertiary); line-height: 1.7; }
    @media (max-width: 640px) {
        .up-drop { padding: 26px 14px; }
        .up-actions .btn { width: 100%; justify-content: center; }
        .up-meta-row { flex-direction: column; gap: 4px; }
        .up-meta-row .k { width: auto; }
    }
</style>

<div class="up-wrapper">
    <div class="page-header">
        <h1 class="page-title">脚本上传</h1>
        <p class="page-subtitle">选择打包好的 .zip 脚本包，脚本信息由服务器自动读取包内 info.prop，无需手动填写</p>
    </div>

        <div class="card">
        <div class="card-header">
            <h2 class="card-title">选择脚本包</h2>
        </div>
        <div class="card-body">
            <label class="up-drop" id="upDrop">
                <input type="file" id="upFile" accept=".zip,application/zip" hidden>
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="28" height="28">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                </span>
                <span class="up-drop-title" id="upFileName">点击选择或拖拽 .zip 文件到此处</span>
                <span class="up-drop-hint">
                    仅支持 .zip 且不超过 10MB<br>
                    包内必须包含 info.prop（pluginName、id、versionCode、author），可选 desc.txt 作为脚本介绍<br>
                    选中文件压缩、直接压缩整个文件夹都可以，服务器会自动去掉外层目录
                </span>
            </label>
            <div class="up-actions">
                <button type="button" class="btn btn-primary" id="upSubmitBtn" disabled>上传并提交审核</button>
                <span class="up-msg" id="upMsg"></span>
            </div>
        </div>
    </div>

    <div class="card" id="upResultCard" style="display: none;">
        <div class="card-header" style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
            <h2 class="card-title">服务器读取到的脚本信息</h2>
            <span class="badge badge-warning">待审核</span>
        </div>
        <div class="card-body">
            <div class="up-meta">
                <div class="up-meta-row"><span class="k">脚本名称</span><span class="v" id="upName"></span></div>
                <div class="up-meta-row"><span class="k">脚本 ID</span><span class="v" id="upId"></span></div>
                <div class="up-meta-row"><span class="k">版本号</span><span class="v" id="upVersion"></span></div>
                <div class="up-meta-row"><span class="k">作者</span><span class="v" id="upAuthor"></span></div>
                <div class="up-meta-row"><span class="k">脚本介绍</span><span class="v" id="upDesc"></span></div>
            </div>
            <p class="up-drop-hint" style="margin: 12px 0 0;">
                以上内容全部由服务器直接从 zip 包内读取，不采用任何手动填写的字段。审核通过后可在「在线脚本」中查看。
            </p>
        </div>
    </div>
    </div>

<script>
(function () {
    var fileInput  = document.getElementById('upFile');
    if (!fileInput) return;

    var drop       = document.getElementById('upDrop');
    var nameEl     = document.getElementById('upFileName');
    var btn        = document.getElementById('upSubmitBtn');
    var msgEl      = document.getElementById('upMsg');
    var resultCard = document.getElementById('upResultCard');
    var defaultText = '点击选择或拖拽 .zip 文件到此处';

    function setMsg(text, isError) {
        msgEl.textContent = text || '';
        msgEl.className = 'up-msg' + (isError ? ' error' : '');
    }

    function pickFile(file) {
        if (!file) return;
        if (!/\.zip$/i.test(file.name)) {
            setMsg('只允许上传 .zip 文件', true);
            fileInput.value = '';
            nameEl.textContent = defaultText;
            btn.disabled = true;
            return;
        }
        if (file.size > 10 * 1024 * 1024) {
            setMsg('文件大小不能超过 10MB', true);
            fileInput.value = '';
            nameEl.textContent = defaultText;
            btn.disabled = true;
            return;
        }
        setMsg('');
        nameEl.textContent = file.name + '（' + (file.size / 1024).toFixed(1) + ' KB）';
        btn.disabled = false;
    }

    fileInput.addEventListener('change', function () {
        pickFile(this.files && this.files[0]);
    });

    ['dragenter', 'dragover'].forEach(function (ev) {
        drop.addEventListener(ev, function (e) {
            e.preventDefault();
            drop.classList.add('dragover');
        });
    });
    ['dragleave', 'drop'].forEach(function (ev) {
        drop.addEventListener(ev, function (e) {
            e.preventDefault();
            drop.classList.remove('dragover');
        });
    });
    drop.addEventListener('drop', function (e) {
        var files = e.dataTransfer ? e.dataTransfer.files : null;
        if (files && files.length) {
            fileInput.files = files;
            pickFile(files[0]);
        }
    });

    btn.addEventListener('click', function () {
        var file = fileInput.files && fileInput.files[0];
        if (!file) {
            setMsg('请先选择 .zip 文件', true);
            return;
        }

        var formData = new FormData();
        formData.append('pluginFile', file);

        var oldText = btn.textContent;
        btn.disabled = true;
        btn.textContent = '上传中...';
        setMsg('正在上传并解析包内 info.prop，请稍候...');

        fetch('../online_plugin/index.php', { method: 'POST', body: formData })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (!res || res.code !== 200) {
                    setMsg((res && res.message) ? res.message : '上传失败，请稍后重试', true);
                    btn.disabled = false;
                    btn.textContent = oldText;
                    return;
                }
                var d = res.data || {};
                document.getElementById('upName').textContent    = d.plugin_name  || '-';
                document.getElementById('upId').textContent      = d.plugin_id    || '-';
                document.getElementById('upVersion').textContent = d.version_code || '-';
                document.getElementById('upAuthor').textContent  = d.author_name  || '-';
                document.getElementById('upDesc').textContent    = d.description  || '-';
                resultCard.style.display = '';
                setMsg('上传成功，等待管理员审核');
                btn.textContent = '继续上传';
                btn.disabled = false;
                fileInput.value = '';
                nameEl.textContent = defaultText;
            })
            .catch(function () {
                setMsg('网络异常，上传失败，请稍后重试', true);
                btn.disabled = false;
                btn.textContent = oldText;
            });
    });
})();
</script>

            </main>
        </div>
    </div>
    <script src="../assets/common.js"></script>
</body>
</html>
