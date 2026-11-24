
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>反馈中心 - QLsu 用户中心</title>
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
                    <a href="feedback.php" class="active">
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
                    <h1 class="topbar-title">反馈中心</h1>
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
    .fb-wrapper { max-width: 1080px; margin: 0 auto; }
    .fb-stat-grid { display:grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin: 14px 0 18px; }
    .fb-stat { padding:14px 10px; text-align:center; background:#fff; border-radius:12px; border:1px solid #e6eef9; border-top: 3px solid #ccc; }
    .fb-stat .num { font-size: 22px; font-weight: 550; color: #1c3450; line-height: 1.2; }
    .fb-stat .lbl { font-size: 12px; color: #3f5b77; margin-top: 4px; }
    .fb-stat.s-pending    { border-top-color: #faad14; } .fb-stat.s-pending .num    { color: #d4880f; }
    .fb-stat.s-processing { border-top-color: #1890ff; } .fb-stat.s-processing .num { color: #096dd9; }
    .fb-stat.s-solved     { border-top-color: #52c41a; } .fb-stat.s-solved .num     { color: #389e0d; }
    .fb-stat.s-closed     { border-top-color: #8c8c8c; } .fb-stat.s-closed .num     { color: #595959; }
    .fb-stat.s-total      { border-top-color: #597ef7; } .fb-stat.s-total .num      { color: #2f54eb; }
    .fb-filter { display:flex; flex-wrap:wrap; gap: 8px; margin: 6px 0 14px; }
    .fb-filter-btn { padding: 7px 18px; border: 1px solid #d9e8f7; background: #fff; border-radius: 40px; cursor:pointer; font-size:13px; color: #3f5b77; transition: all .2s; }
    .fb-filter-btn.active { background: #1890ff; border-color: #1890ff; color: #fff; }
    .fb-filter-btn:hover:not(.active) { border-color: #9bbde0; color: #1e2b3c; }
    .fb-card { background: #fff; border-radius: 16px; border: 1px solid #e6eef9; padding: 16px 18px; margin-bottom: 12px; transition: all .2s; cursor: pointer; }
    .fb-card:hover { border-color: #b8d0e8; box-shadow: 0 2px 10px rgba(190,212,235,.12); }
    .fb-card-head { display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap: 8px; margin-bottom: 8px; }
    .fb-card-title { font-size: 15px; font-weight: 550; color: #1c3450; word-break: break-word; line-height: 1.4; flex:1; min-width: 0; padding-right: 10px; }
    .fb-status { display:inline-block; padding: 2px 12px; border-radius: 30px; font-size: 12px; font-weight: 500; white-space: nowrap; border: 1px solid transparent; }
    .fb-status.pending    { background:#fff7e6; color:#d4880f; border-color:#ffe58f; }
    .fb-status.processing { background:#e6f7ff; color:#096dd9; border-color:#91d5ff; }
    .fb-status.solved     { background:#f6ffed; color:#389e0d; border-color:#b7eb8f; }
    .fb-status.closed     { background:#f5f5f5; color:#595959; border-color:#d9d9d9; }
    .fb-card-meta { display:flex; flex-wrap:wrap; gap: 14px; font-size: 12px; color: #6b8aa9; margin-bottom: 8px; }
    .fb-card-preview { font-size: 13px; color: #3f5b77; line-height: 1.65; background:#f8fcff; border-radius: 8px; padding: 8px 12px; border-left: 3px solid #dce8f5;
                       display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .fb-reply-badge { margin-top: 10px; padding: 8px 12px; border-radius: 8px; background: #f0f5ff; border: 1px solid #d6e4ff; font-size: 12px; color: #2f54eb; }
    .fb-form-grid { display:grid; gap: 12px; }
    .fb-form-label { display:block; font-size:13px; color:#3f5b77; margin-bottom: 6px; }
    .fb-form-title { width:100%; padding: 10px 12px; border:1px solid #d9e8f7; border-radius: 8px; font-size: 14px; box-sizing: border-box; color:#1e2b3c; background:#fff; }
    .fb-form-title:focus, .fb-form-content:focus { outline:none; border-color:#9bbde0; box-shadow: 0 0 0 3px rgba(155,189,224,.15); }
    .fb-form-content { width:100%; min-height: 140px; padding: 10px 12px; border:1px solid #d9e8f7; border-radius: 8px; font-size:14px; box-sizing: border-box; resize: vertical; line-height: 1.65; color:#1e2b3c; background:#fff; font-family: inherit; }
    .fb-count { text-align:right; font-size: 12px; color:#6b8aa9; margin-top: 4px; }
    .fb-empty { text-align:center; padding: 40px 20px; color:#6b8aa9; font-size: 14px; }
    .fb-modal-overlay { display:none; position:fixed; inset:0; background: rgba(10, 30, 60, 0.45); z-index: 1000; justify-content:center; align-items:flex-start; padding: 24px 20px; overflow-y:auto; }
    .fb-modal-overlay.show { display:flex; }
    .fb-modal { background:#fff; border-radius: 16px; width:100%; max-width: 640px; border: 1px solid #e6eef9; box-shadow: 0 8px 30px rgba(155,189,224,.2); }
    .fb-modal-head { padding: 16px 20px; border-bottom: 1px solid #eef4fb; display:flex; justify-content:space-between; align-items:center; gap: 10px; }
    .fb-modal-head h3 { margin:0; font-size: 16px; color: #1c3450; font-weight: 550; line-height: 1.4; flex:1; word-break: break-word; }
    .fb-modal-close { border:0; background: transparent; cursor:pointer; padding: 6px; border-radius: 8px; color:#6b8aa9; display:flex; align-items:center; }
    .fb-modal-close:hover { background: #f0f6fe; color: #1e2b3c; }
    .fb-modal-body { padding: 18px 20px; font-size: 14px; line-height: 1.7; color: #1f3347; }
    .fb-meta-row { display:flex; flex-wrap:wrap; gap: 16px; font-size:12px; color:#6b8aa9; margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px dashed #e2edf9; }
    .fb-detail-content { padding: 12px 14px; background:#f8fcff; border-radius: 10px; border-left: 3px solid #dce8f5; white-space: pre-wrap; word-break: break-word; }
    .fb-detail-reply { margin-top: 18px; padding: 12px 14px; background: #f0f9ff; border-radius: 10px; border: 1px solid #bae0ff; }
    .fb-detail-reply .h { font-size: 13px; color: #096dd9; margin-bottom: 6px; font-weight: 550; }
    .fb-detail-reply .t { font-size: 12px; color: #6b8aa9; margin-bottom: 6px; }
    .fb-detail-reply .c { white-space: pre-wrap; word-break: break-word; color:#1e2b3c; line-height:1.7; font-size: 14px; }
    .fb-modal-foot { padding: 12px 20px 18px; border-top: 1px solid #eef4fb; text-align:right; }
    @media (max-width: 680px) {
        .fb-stat-grid { grid-template-columns: repeat(2, 1fr); }
        .fb-filter-btn { flex: 1; text-align: center; padding: 7px 10px; }
        .fb-modal { border-radius: 14px; }
    }
    @media (max-width: 420px) {
        .fb-stat-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
        .fb-card { padding: 12px 14px; border-radius: 14px; }
    }
</style>


<div class="fb-wrapper">

    <!-- 提交新反馈 -->
    <div class="card" style="margin-bottom: 18px;">
        <div class="card-header">
            <h3 class="card-title">提交新反馈</h3>
            <small style="color:#6b8aa9;">遇到任何问题都可以在这里反馈，我们会尽快处理回复</small>
        </div>
        <div class="card-body">
            <form id="fbForm" class="fb-form-grid">
                <div>
                    <label class="fb-form-label">标题 <span style="color:#ff4d4f;">*</span> <span style="color:#6b8aa9;font-weight:normal;">（一句话描述问题，≤ 200 字）</span></label>
                    <input type="text" id="fbTitle" class="fb-form-title" maxlength="200" placeholder="例：脚本下载后无法加载 / 在线脚本列表打开失败 / 建议增加xxx功能">
                </div>
                <div>
                    <label class="fb-form-label">详细内容 <span style="color:#ff4d4f;">*</span> <span style="color:#6b8aa9;font-weight:normal;">（≤ 3000 字）</span></label>
                    <textarea id="fbContent" class="fb-form-content" maxlength="3000" placeholder="请详细描述遇到的问题：&#10;1) 操作步骤（如：进入用户中心-点击xxx）&#10;2) 预期结果 / 实际结果&#10;3) 其他补充信息（QQ版本、模块版本、机型等）"></textarea>
                    <div class="fb-count"><span id="fbCount">0</span>/3000</div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" id="fbSubmit">提交反馈</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 我的反馈统计 -->
    <div class="card" style="margin-bottom: 18px;">
        <div class="card-header">
            <h3 class="card-title">我的反馈</h3>
            <small style="color:#6b8aa9;">共 0 条记录</small>
        </div>
        <div class="card-body">
            <div class="fb-stat-grid">
                <div class="fb-stat s-total">      <div class="num">0</div>      <div class="lbl">全部</div></div>
                <div class="fb-stat s-pending">    <div class="num">0</div>    <div class="lbl">待处理</div></div>
                <div class="fb-stat s-processing"> <div class="num">0</div> <div class="lbl">处理中</div></div>
                <div class="fb-stat s-solved">     <div class="num">0</div>     <div class="lbl">已解决</div></div>
                <div class="fb-stat s-closed">     <div class="num">0</div>     <div class="lbl">已关闭</div></div>
            </div>
            <div class="fb-filter">
                <button class="fb-filter-btn active" onclick="location.href='feedback.php?status=-1'">全部</button>
                <button class="fb-filter-btn " onclick="location.href='feedback.php?status=0'">待处理</button>
                <button class="fb-filter-btn " onclick="location.href='feedback.php?status=1'">处理中</button>
                <button class="fb-filter-btn " onclick="location.href='feedback.php?status=2'">已解决</button>
                <button class="fb-filter-btn " onclick="location.href='feedback.php?status=3'">已关闭</button>
            </div>

                            <div class="fb-empty">当前筛选条件下没有反馈记录</div>
                    </div>
    </div>
</div>

<!-- 反馈详情弹窗 -->
<div class="fb-modal-overlay" id="fbDetailOverlay">
    <div class="fb-modal">
        <div class="fb-modal-head">
            <h3 id="fbDetailTitle">反馈详情</h3>
            <button class="fb-modal-close" onclick="closeFbDetail()" aria-label="关闭">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="fb-modal-body">
            <div class="fb-meta-row">
                <span id="fbDetailStatus"></span>
                <span>编号：<b id="fbDetailId"></b></span>
                <span>提交时间：<b id="fbDetailTime"></b></span>
            </div>
            <div style="font-size:12px; color:#6b8aa9; margin-bottom: 6px;">反馈内容</div>
            <div class="fb-detail-content" id="fbDetailContent"></div>
            <div class="fb-detail-reply" id="fbDetailReplyBlock" style="display:none;">
                <div class="h"><span id="fbDetailReplyWho">管理员</span> 的处理回复</div>
                <div class="t" id="fbDetailReplyTime"></div>
                <div class="c" id="fbDetailReplyBody"></div>
            </div>
        </div>
        <div class="fb-modal-foot">
            <button class="btn btn-secondary" onclick="closeFbDetail()">关闭</button>
        </div>
    </div>
</div>

<script>
    var fbCsrf = '30b5140ee4af716fdb393613444f5d090c86544ab65a1102ca684ffa2a67fa41';
    var fbStatusMap = {
        pending:    {cls: 'fb-status pending',    text: '待处理'},
        processing: {cls: 'fb-status processing', text: '处理中'},
        solved:     {cls: 'fb-status solved',     text: '已解决'},
        closed:     {cls: 'fb-status closed',     text: '已关闭'}
    };

    // 字数统计
    var contentEl = document.getElementById('fbContent');
    var countEl = document.getElementById('fbCount');
    if (contentEl && countEl) {
        var up = function() { countEl.textContent = contentEl.value.length; };
        contentEl.addEventListener('input', up); up();
    }

    // 提交反馈
    document.getElementById('fbForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var title   = document.getElementById('fbTitle').value.trim();
        var content = document.getElementById('fbContent').value;
        var btn     = document.getElementById('fbSubmit');

        if (!title)   { if (typeof Toast!=='undefined') Toast.error('请填写标题');   else alert('请填写标题');   document.getElementById('fbTitle').focus();   return; }
        if (!content) { if (typeof Toast!=='undefined') Toast.error('请填写详细内容'); else alert('请填写详细内容'); document.getElementById('fbContent').focus(); return; }

        if (typeof Loading!=='undefined') Loading.show();
        btn.disabled = true; btn.textContent = '提交中...';

        fetch('../api/user/feedback_submit.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title: title, content: content, csrf_token: fbCsrf })
        })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (typeof Loading!=='undefined') Loading.hide();
            btn.disabled = false; btn.textContent = '提交反馈';
            if (data.code === 200) {
                if (typeof Toast!=='undefined') Toast.success(data.message || '提交成功');
                setTimeout(function(){ location.reload(); }, 900);
            } else {
                if (typeof Toast!=='undefined') Toast.error(data.message || '提交失败');
                else alert(data.message || '提交失败');
            }
        })
        .catch(function() {
            if (typeof Loading!=='undefined') Loading.hide();
            btn.disabled = false; btn.textContent = '提交反馈';
            if (typeof Toast!=='undefined') Toast.error('网络错误，请稍后重试');
            else alert('网络错误，请稍后重试');
        });
    });

    // 打开详情
    function openFbDetail(couldId) {
        var card = document.querySelector('.fb-card[data-could_id="' + couldId + '"]');
        if (!card) return;
        var ds = card.dataset;

        document.getElementById('fbDetailTitle').textContent = ds.title || '反馈详情';
        var statusInfo = fbStatusMap[ds.status_class] || fbStatusMap.pending;
        document.getElementById('fbDetailStatus').innerHTML = '<span class="' + statusInfo.cls + '">' + statusInfo.text + '</span>';
        document.getElementById('fbDetailId').textContent   = '#' + couldId;
        document.getElementById('fbDetailTime').textContent = ds.create_time || '';
        document.getElementById('fbDetailContent').textContent = ds.content || '';

        var replyBlock = document.getElementById('fbDetailReplyBlock');
        if (ds.reply && ds.reply !== '') {
            replyBlock.style.display = 'block';
            document.getElementById('fbDetailReplyWho').textContent  = ds.reply_nickname || '管理员';
            document.getElementById('fbDetailReplyTime').textContent = ds.reply_time ? ('回复时间：' + ds.reply_time) : '';
            document.getElementById('fbDetailReplyBody').textContent = ds.reply;
        } else {
            replyBlock.style.display = 'none';
        }
        document.getElementById('fbDetailOverlay').classList.add('show');
    }

    function closeFbDetail() {
        document.getElementById('fbDetailOverlay').classList.remove('show');
    }

    document.getElementById('fbDetailOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeFbDetail();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeFbDetail();
    });
</script>

            </main>
        </div>
    </div>
    <script src="../assets/common.js"></script>
</body>
</html>
