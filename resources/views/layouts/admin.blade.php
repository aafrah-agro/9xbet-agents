<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — 9XBET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{
            --bg:#0b0f1a;--sidebar:#0d1526;--card:#141d2f;--border:#1e2d45;
            --primary:#f59e0b;--red:#ef4444;--green:#22c55e;--text:#e2e8f0;--muted:#94a3b8;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{background:var(--bg);color:var(--text);font-family:'Segoe UI',system-ui,sans-serif;display:flex;min-height:100vh}
        a{text-decoration:none;color:inherit}

        /* SIDEBAR */
        .sidebar{width:240px;background:var(--sidebar);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;height:100vh;top:0;left:0;z-index:50;transition:transform .2s}
        .sidebar-logo{padding:20px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px}
        .sidebar-logo .mark{width:36px;height:36px;background:var(--primary);border-radius:6px;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1rem;color:#000}
        .sidebar-logo span{font-size:.85rem;font-weight:700;color:var(--primary)}
        .sidebar-logo small{display:block;font-size:.65rem;color:var(--muted)}
        .sidebar-nav{flex:1;padding:12px 0;overflow-y:auto}
        .nav-label{padding:10px 16px 4px;font-size:.65rem;text-transform:uppercase;letter-spacing:1px;color:var(--muted)}
        .sidebar-nav a{display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:.83rem;color:var(--muted);transition:all .15s;border-left:3px solid transparent}
        .sidebar-nav a:hover{color:var(--text);background:rgba(255,255,255,.04)}
        .sidebar-nav a.active{color:var(--primary);background:rgba(245,158,11,.08);border-left-color:var(--primary)}
        .sidebar-nav a i{width:16px;text-align:center;font-size:.85rem}
        .sidebar-footer{padding:12px 16px;border-top:1px solid var(--border)}
        .sidebar-footer form button{width:100%;background:transparent;border:1px solid var(--border);color:var(--muted);padding:8px;border-radius:6px;font-size:.8rem;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .15s}
        .sidebar-footer form button:hover{background:var(--red);border-color:var(--red);color:#fff}

        /* MAIN */
        .main-wrap{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh}
        .topbar{background:var(--sidebar);border-bottom:1px solid var(--border);padding:14px 24px;display:flex;align-items:center;justify-content:space-between}
        .topbar h1{font-size:1rem;font-weight:700;color:var(--text)}
        .topbar-right{display:flex;align-items:center;gap:10px;font-size:.8rem;color:var(--muted)}
        .topbar-right i{color:var(--primary)}
        .content{padding:24px;flex:1}

        /* CARDS */
        .card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:20px}
        .card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--border)}
        .card-header h2{font-size:.9rem;font-weight:700;color:var(--text)}

        /* STAT CARDS */
        .stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:24px}
        .stat-card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:16px;text-align:center}
        .stat-card .val{font-size:1.8rem;font-weight:800;color:var(--primary)}
        .stat-card .lbl{font-size:.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-top:4px}

        /* TABLE */
        .tbl-wrap{overflow-x:auto}
        table{width:100%;border-collapse:collapse;font-size:.83rem}
        thead th{background:#0d1526;color:var(--primary);padding:10px 12px;text-align:left;font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid var(--border)}
        tbody tr{border-bottom:1px solid var(--border);transition:background .1s}
        tbody tr:hover{background:rgba(255,255,255,.03)}
        td{padding:10px 12px;vertical-align:middle}

        /* BADGES */
        .badge{display:inline-block;padding:3px 8px;border-radius:4px;font-size:.68rem;font-weight:700;text-transform:uppercase}
        .badge-admin{background:#7c3aed22;color:#a78bfa;border:1px solid #7c3aed44}
        .badge-super{background:#0ea5e922;color:#38bdf8;border:1px solid #0ea5e944}
        .badge-agent{background:#22c55e22;color:#4ade80;border:1px solid #22c55e44}
        .badge-cs{background:#f59e0b22;color:#fcd34d;border:1px solid #f59e0b44}
        .badge-active{background:#22c55e22;color:#4ade80;border:1px solid #22c55e44}
        .badge-inactive{background:#ef444422;color:#f87171;border:1px solid #ef444444}

        /* FORMS */
        .form-group{margin-bottom:16px}
        .form-group label{display:block;font-size:.8rem;color:var(--muted);margin-bottom:6px;font-weight:600}
        .form-control{width:100%;background:#0d1526;border:1px solid var(--border);color:var(--text);padding:9px 12px;border-radius:6px;font-size:.88rem;outline:none;transition:border .15s}
        .form-control:focus{border-color:var(--primary)}
        select.form-control option{background:#0d1526}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .form-row-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
        .form-check{display:flex;align-items:center;gap:8px;font-size:.85rem}
        .form-check input[type=checkbox]{width:16px;height:16px;accent-color:var(--primary);cursor:pointer}

        /* BUTTONS */
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:6px;font-size:.82rem;font-weight:600;cursor:pointer;border:none;transition:all .15s}
        .btn-primary{background:var(--primary);color:#000}
        .btn-primary:hover{background:var(--primary2,#d97706)}
        .btn-secondary{background:var(--card);color:var(--text);border:1px solid var(--border)}
        .btn-secondary:hover{background:#1a2540}
        .btn-danger{background:transparent;color:var(--red);border:1px solid var(--red)}
        .btn-danger:hover{background:var(--red);color:#fff}
        .btn-sm{padding:5px 10px;font-size:.75rem}

        /* ALERTS */
        .alert{padding:10px 14px;border-radius:6px;margin-bottom:16px;font-size:.85rem;display:flex;align-items:center;gap:8px}
        .alert-success{background:#22c55e22;border:1px solid #22c55e44;color:#4ade80}
        .alert-error{background:#ef444422;border:1px solid #ef444444;color:#f87171}

        /* ERROR TEXT */
        .err{color:#f87171;font-size:.75rem;margin-top:4px}

        /* PAGINATION */
        .pagination{display:flex;gap:6px;margin-top:16px;flex-wrap:wrap}
        .pagination a,.pagination span{padding:6px 10px;background:var(--card);border:1px solid var(--border);border-radius:4px;font-size:.78rem;color:var(--muted)}
        .pagination .active span{background:var(--primary);border-color:var(--primary);color:#000;font-weight:700}

        /* MOBILE TOGGLE */
        .mobile-toggle{display:none;background:none;border:none;color:var(--text);font-size:1.2rem;cursor:pointer}
        @media(max-width:768px){
            .sidebar{transform:translateX(-240px)}
            .sidebar.open{transform:translateX(0)}
            .main-wrap{margin-left:0}
            .mobile-toggle{display:block}
            .form-row,.form-row-3{grid-template-columns:1fr}
        }
        .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:40}
        .overlay.active{display:block}
    </style>
    @stack('head')
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="mark">9X</div>
        <div>
            <span>9XBET</span>
            <small>Admin Panel</small>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-gauge-high"></i> Dashboard
        </a>
        <div class="nav-label">Agents</div>
        <a href="{{ route('admin.agents.index') }}" class="{{ request()->routeIs('admin.agents.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> All Agents
        </a>
        <a href="{{ route('admin.agents.create') }}" class="{{ request()->routeIs('admin.agents.create') ? 'active' : '' }}">
            <i class="fas fa-user-plus"></i> Add Agent
        </a>
        <div class="nav-label">Settings</div>
        <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fas fa-sliders"></i> Site Settings
        </a>
        <a href="{{ route('admin.social-links.index') }}" class="{{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
            <i class="fas fa-share-nodes"></i> Social Links
        </a>
        <a href="{{ route('admin.partner-sites.index') }}" class="{{ request()->routeIs('admin.partner-sites.*') ? 'active' : '' }}">
            <i class="fas fa-handshake"></i> Partner Sites
        </a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"><i class="fas fa-right-from-bracket"></i> Logout</button>
        </form>
    </div>
</aside>

<div class="main-wrap">
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:12px">
            <button class="mobile-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
            <h1>@yield('title', 'Dashboard')</h1>
        </div>
        <div class="topbar-right">
            <i class="fas fa-circle-user"></i>
            {{ auth()->user()->name }}
        </div>
    </div>

    <div class="content">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-circle-xmark"></i> {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script>
function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
}
function closeSidebar(){
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('active');
}
</script>
@stack('scripts')
</body>
</html>
