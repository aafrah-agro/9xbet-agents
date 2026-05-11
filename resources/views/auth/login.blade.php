<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — 9XBET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{background:#0b0f1a;color:#e2e8f0;font-family:'Segoe UI',system-ui,sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:16px}
        .box{background:#141d2f;border:1px solid #1e2d45;border-radius:12px;padding:36px;width:100%;max-width:400px}
        .logo{text-align:center;margin-bottom:28px}
        .logo .mark{width:56px;height:56px;background:#f59e0b;border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.4rem;color:#000;margin:0 auto 10px}
        .logo h1{font-size:1.1rem;font-weight:700;color:#f59e0b}
        .logo p{font-size:.75rem;color:#94a3b8;margin-top:3px}
        .form-group{margin-bottom:16px}
        label{display:block;font-size:.78rem;color:#94a3b8;margin-bottom:6px;font-weight:600}
        input{width:100%;background:#0d1526;border:1px solid #1e2d45;color:#e2e8f0;padding:10px 12px;border-radius:6px;font-size:.88rem;outline:none;transition:border .15s}
        input:focus{border-color:#f59e0b}
        .btn{width:100%;background:#f59e0b;color:#000;border:none;padding:11px;border-radius:6px;font-weight:700;font-size:.9rem;cursor:pointer;margin-top:8px;transition:background .15s}
        .btn:hover{background:#d97706}
        .alert{background:#ef444422;border:1px solid #ef444444;color:#f87171;padding:10px 12px;border-radius:6px;margin-bottom:16px;font-size:.83rem;display:flex;align-items:center;gap:8px}
        .remember{display:flex;align-items:center;gap:8px;font-size:.82rem;color:#94a3b8;margin-bottom:4px}
        .remember input{width:15px;height:15px;accent-color:#f59e0b}
    </style>
</head>
<body>
<div class="box">
    <div class="logo">
        <div class="mark">9X</div>
        <h1>Admin Panel</h1>
        <p>9XBET Agent Management</p>
    </div>

    @if($errors->any())
    <div class="alert"><i class="fas fa-circle-xmark"></i> {{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
        </div>
        <div class="form-group">
            <label><i class="fas fa-lock"></i> Password</label>
            <input type="password" name="password" required autocomplete="current-password">
        </div>
        <div class="remember">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" style="margin:0;cursor:pointer">Remember me</label>
        </div>
        <button type="submit" class="btn"><i class="fas fa-right-to-bracket"></i> Login</button>
    </form>
</div>
</body>
</html>
