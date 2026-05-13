<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', $setting->meta_title)</title>
    <meta name="description" content="@yield('meta_description', $setting->meta_description)">
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', $setting->meta_title)">
    <meta property="og:description" content="@yield('meta_description', $setting->meta_description)">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $setting->site_name }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', $setting->meta_title)">
    <meta name="twitter:description" content="@yield('meta_description', $setting->meta_description)">

    <script type="application/ld+json">{"@@context":"https://schema.org","@@type":"WebSite","name":"{{ $setting->site_name }}","url":"{{ config('app.url') }}","description":"{{ $setting->meta_description }}"}</script>

    @if($setting->favicon)
    <link rel="icon" href="{{ asset('storage/' . $setting->favicon) }}" type="image/x-icon">
    @else
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><rect width='64' height='64' rx='12' fill='%231b5e20'/><text x='50%25' y='38' font-family='Arial Black,Arial' font-weight='900' font-size='22' fill='%23ffd700' text-anchor='middle'>9X</text><text x='50%25' y='54' font-family='Arial Black,Arial' font-weight='700' font-size='11' fill='%2381c784' text-anchor='middle'>BET</text></svg>" type="image/svg+xml">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --green:      #1b5e20;
            --green-med:  #2e7d32;
            --green-lt:   #43a047;
            --green-pale: #e8f5e9;
            --green-row:  #f1f8f2;
            --green-bdr:  #a5d6a7;
            --accent:     #00c851;
            --text:       #111827;
            --muted:      #4b5563;
            --bg:         #f4faf5;
            --white:      #ffffff;
            --wa:         #25D366;
            --red:        #c62828;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{
            background:var(--bg);
            color:var(--text);
            font-family:'Hind Siliguri',Arial,sans-serif;
            font-size:15px;
            min-height:100vh;
        }
        a{text-decoration:none;color:inherit}
        img{max-width:100%}

        /* ── TOPBAR ── */
        .topbar{
            background:linear-gradient(135deg,var(--green) 0%,var(--green-med) 60%,var(--green-lt) 100%);
            padding:0;
            box-shadow:0 2px 8px rgba(0,0,0,.18);
        }
        .topbar-inner{
            max-width:1200px;margin:0 auto;
            display:flex;align-items:center;justify-content:space-between;
            padding:12px 16px;gap:12px;
        }
        .logo-wrap{display:flex;align-items:center;gap:12px}
        .logo-mark{
            width:48px;height:48px;
            background:var(--white);border-radius:8px;
            display:flex;align-items:center;justify-content:center;
            font-weight:900;font-size:1.15rem;color:var(--green);
            letter-spacing:-1px;flex-shrink:0;
            box-shadow:0 2px 6px rgba(0,0,0,.2);
        }
        .logo-wrap img{height:48px;object-fit:contain}
        .site-name{font-size:1.1rem;font-weight:700;color:#fff;line-height:1.25;letter-spacing:.3px}
        .site-tagline{font-size:.68rem;color:#c8e6c9;letter-spacing:.5px;margin-top:1px}
        .badge-live{
            background:var(--red);color:#fff;
            font-size:.62rem;font-weight:800;
            padding:4px 10px;border-radius:20px;
            letter-spacing:.8px;flex-shrink:0;
            display:flex;align-items:center;gap:4px;
            animation:xpulse 1.5s infinite;
            box-shadow:0 2px 6px rgba(198,40,40,.4);
        }
        @@keyframes xpulse{0%,100%{opacity:1}50%{opacity:.6}}

        /* ── TICKER ── */
        .ticker{
            background:var(--green);
            color:#fff;
            padding:7px 0;
            display:flex;
            align-items:center;
            overflow:hidden;
            border-bottom:2px solid var(--accent);
        }
        .ticker-label{
            background:var(--accent);
            color:#000;
            font-size:.72rem;
            font-weight:800;
            padding:3px 12px;
            white-space:nowrap;
            letter-spacing:.5px;
            flex-shrink:0;
            margin-right:12px;
            height:100%;
            display:flex;
            align-items:center;
        }
        .ticker-scroll{overflow:hidden;flex:1}
        .ticker-text{
            white-space:nowrap;
            font-size:.82rem;
            font-weight:500;
            display:inline-block;
            animation:xticker 65s linear infinite;
        }
        @@keyframes xticker{0%{transform:translateX(100vw)}100%{transform:translateX(-100%)}}

        /* ── NAVBAR ── */
        .navbar{
            background:var(--white);
            border-bottom:3px solid var(--green);
            position:sticky;top:0;z-index:100;
            box-shadow:0 2px 8px rgba(0,0,0,.1);
        }
        .nav-inner{max-width:1200px;margin:0 auto;display:flex;overflow-x:auto;scrollbar-width:none}
        .nav-inner::-webkit-scrollbar{display:none}
        .nav-inner a{
            white-space:nowrap;
            padding:13px 18px;
            font-size:.82rem;
            font-weight:700;
            color:var(--muted);
            border-bottom:3px solid transparent;
            margin-bottom:-3px;
            transition:all .2s;
            display:flex;align-items:center;gap:6px;
        }
        .nav-inner a:hover,.nav-inner a.active{
            color:var(--green);
            border-bottom-color:var(--green);
            background:var(--green-pale);
        }

        /* ── MAIN ── */
        .main{max-width:1200px;margin:0 auto;padding:20px 12px 50px}

        /* ── SECTION HEADER ── */
        .sec-header{
            background:var(--green);
            color:#fff;
            padding:11px 16px;
            margin:28px 0 0;
            display:flex;align-items:center;justify-content:space-between;
            border-radius:6px 6px 0 0;
        }
        .sec-header h2{
            font-size:.92rem;font-weight:700;
            display:flex;align-items:center;gap:8px;
        }
        .sec-header .count{
            background:var(--accent);color:#000;
            font-size:.68rem;font-weight:800;
            padding:2px 10px;border-radius:20px;
        }

        /* ── SPREADSHEET TABLE ── */
        .tbl-wrap{
            overflow-x:auto;
            border:1.5px solid var(--green-bdr);
            border-top:none;
            border-radius:0 0 6px 6px;
            box-shadow:0 2px 8px rgba(0,0,0,.07);
        }
        table{width:100%;border-collapse:collapse;font-size:.85rem}
        thead th{
            background:#e8f5e9;
            color:var(--green);
            padding:9px 10px;
            text-align:center;
            font-size:.74rem;
            font-weight:700;
            border-right:1px solid var(--green-bdr);
            border-bottom:2px solid var(--green-bdr);
            white-space:nowrap;
        }
        thead th.th-name{text-align:left}
        thead th:last-child{border-right:none}
        .th-num{width:44px;background:#dcedc8;color:var(--green);font-weight:800}

        tbody tr{
            background:var(--white);
            border-bottom:1px solid #e2ede3;
            transition:background .12s;
        }
        tbody tr:nth-child(even){background:var(--green-row)}
        tbody tr:hover{background:#d0edda !important}

        td{
            padding:8px 10px;
            text-align:center;
            vertical-align:middle;
            border-right:1px solid #e2ede3;
            color:var(--text);
        }
        td:last-child{border-right:none}
        .td-num{
            background:#f9fbe7;
            color:var(--muted);
            font-size:.75rem;
            font-weight:700;
            width:44px;
            border-right:1px solid var(--green-bdr) !important;
        }
        .agent-id{
            font-family:monospace;
            color:var(--green-med);
            font-weight:700;
            font-size:.9rem;
            background:#e8f5e9;
            padding:2px 8px;
            border-radius:4px;
            display:inline-block;
        }
        .agent-name{font-weight:600;color:var(--text)}

        /* ── BUTTONS ── */
        .btn-wa{
            display:inline-flex;align-items:center;gap:5px;
            background:var(--wa);color:#fff;
            padding:5px 12px;border-radius:4px;
            font-size:.77rem;font-weight:700;
            transition:opacity .2s;
            white-space:nowrap;
        }
        .btn-wa:hover{opacity:.85}
        .btn-contact{
            display:inline-flex;align-items:center;gap:5px;
            background:#6d28d9;color:#fff;
            padding:5px 12px;border-radius:4px;
            font-size:.77rem;font-weight:700;
            transition:opacity .2s;
        }
        .btn-contact:hover{opacity:.85}

        /* ── SEARCH ── */
        .search-wrap{margin:16px 0 4px;display:flex;gap:8px;flex-wrap:wrap}
        .search-wrap input{
            flex:1;min-width:200px;
            background:var(--white);
            border:1.5px solid var(--green-bdr);
            color:var(--text);
            padding:9px 14px;border-radius:4px;
            font-size:.88rem;font-family:'Hind Siliguri',Arial,sans-serif;
            outline:none;transition:border .2s;
        }
        .search-wrap input::placeholder{color:var(--muted)}
        .search-wrap input:focus{border-color:var(--green)}
        .search-wrap button{
            background:var(--green);color:#fff;
            border:none;padding:9px 20px;border-radius:4px;
            font-weight:700;font-size:.85rem;
            font-family:'Hind Siliguri',Arial,sans-serif;
            cursor:pointer;transition:background .2s;
            white-space:nowrap;
        }
        .search-wrap button:hover{background:var(--green-med)}
        .btn-clear{
            background:var(--white);color:var(--muted);
            border:1.5px solid var(--green-bdr);
            padding:9px 14px;border-radius:4px;
            font-size:.85rem;cursor:pointer;
            display:flex;align-items:center;gap:4px;
        }
        .btn-clear:hover{background:var(--green-pale)}

        /* ── PARTNER SITES ── */
        .partners{
            margin-top:28px;
            background:var(--white);
            border:1.5px solid var(--green-bdr);
            border-radius:8px;padding:18px 20px;
            box-shadow:0 2px 8px rgba(0,0,0,.06);
        }
        .partners h3{
            color:var(--green);font-size:.85rem;font-weight:700;
            margin-bottom:12px;
            display:flex;align-items:center;gap:8px;
            border-bottom:2px solid var(--green-pale);
            padding-bottom:10px;
        }
        .partner-list{display:flex;flex-wrap:wrap;gap:8px;margin-top:4px}
        .partner-link{
            background:var(--green-pale);
            border:1.5px solid var(--green-bdr);
            color:var(--green);
            padding:6px 14px;border-radius:4px;
            font-size:.8rem;font-weight:700;
            transition:all .2s;
            display:flex;align-items:center;gap:6px;
        }
        .partner-link:hover{background:var(--green);color:#fff;border-color:var(--green)}

        /* ── FAQ ── */
        .faq{
            margin-top:24px;
            background:var(--white);
            border:1.5px solid var(--green-bdr);
            border-radius:8px;padding:20px;
            box-shadow:0 2px 8px rgba(0,0,0,.06);
        }
        .faq h3{
            color:var(--green);font-size:.9rem;font-weight:700;
            margin-bottom:14px;
            display:flex;align-items:center;gap:8px;
            border-bottom:2px solid var(--green-pale);
            padding-bottom:10px;
        }
        .faq-item{
            border-bottom:1px solid var(--green-pale);
            padding:10px 0;cursor:pointer;
        }
        .faq-item:last-child{border-bottom:none;padding-bottom:0}
        .faq-q{
            color:var(--text);font-size:.87rem;font-weight:600;
            display:flex;justify-content:space-between;align-items:center;gap:12px;
        }
        .faq-q i{color:var(--muted);font-size:.75rem;flex-shrink:0;transition:transform .2s}
        .faq-item.open .faq-q i{transform:rotate(180deg)}
        .faq-item.open .faq-q{color:var(--green)}
        .faq-a{color:var(--muted);font-size:.83rem;line-height:1.7;margin-top:8px;display:none}
        .faq-item.open .faq-a{display:block}

        /* ── SHUFFLE BTN ── */
        .btn-shuffle{
            background:rgba(255,255,255,.15);
            border:1px solid rgba(255,255,255,.4);
            color:#fff;
            padding:4px 10px;border-radius:4px;
            font-size:.72rem;font-weight:700;
            cursor:pointer;
            display:flex;align-items:center;gap:5px;
            transition:background .2s;
            font-family:'Hind Siliguri',Arial,sans-serif;
            white-space:nowrap;
        }
        .btn-shuffle:hover{background:rgba(255,255,255,.28)}
        .btn-shuffle i{transition:transform .45s cubic-bezier(.4,0,.2,1)}
        .btn-shuffle.spinning i{transform:rotate(360deg)}

        /* ── DISCLAIMER ── */
        .disclaimer{
            background:var(--green-pale);
            border:1.5px solid var(--green-bdr);
            border-radius:6px;padding:14px 16px;
            margin-top:18px;font-size:.77rem;
            color:var(--muted);line-height:1.65;
        }
        .disclaimer strong{color:var(--green)}

        /* ── FOOTER ── */
        footer{
            background:var(--green);
            color:#c8e6c9;
            padding:28px 16px;
            text-align:center;
            margin-top:40px;
        }
        .footer-socials{display:flex;justify-content:center;gap:12px;margin-bottom:16px;flex-wrap:wrap}
        .footer-socials a{
            width:40px;height:40px;border-radius:50%;
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.25);
            display:flex;align-items:center;justify-content:center;
            color:#fff;font-size:1rem;transition:all .2s;
        }
        .footer-socials a:hover{background:var(--accent);color:#000;border-color:var(--accent)}
        .footer-text{color:#a5d6a7;font-size:.78rem}
        .footer-text strong{color:var(--accent)}
        .footer-divider{border:none;border-top:1px solid rgba(255,255,255,.15);margin:14px auto;max-width:400px}

        /* ── BOT WIDGET ── */
        #bot-btn{
            position:fixed;bottom:24px;right:24px;
            width:58px;height:58px;border-radius:50%;
            background:var(--green);
            border:3px solid var(--accent);
            cursor:pointer;z-index:999;
            box-shadow:0 4px 20px rgba(0,150,50,.35);
            display:flex;align-items:center;justify-content:center;
            font-size:1.4rem;color:#fff;
            transition:transform .2s;
        }
        #bot-btn:hover{transform:scale(1.1)}
        #bot-btn .bot-notif{
            position:absolute;top:-2px;right:-2px;
            width:18px;height:18px;background:var(--red);border-radius:50%;
            font-size:.6rem;color:#fff;
            display:flex;align-items:center;justify-content:center;
            font-weight:800;border:2px solid var(--white);
        }
        #bot-panel{
            position:fixed;bottom:94px;right:24px;
            width:320px;max-height:490px;
            background:var(--white);
            border:2px solid var(--green-bdr);
            border-radius:14px;z-index:999;
            display:none;flex-direction:column;
            box-shadow:0 8px 40px rgba(0,0,0,.18);
            overflow:hidden;
        }
        #bot-panel.open{display:flex}
        .bot-head{
            background:linear-gradient(90deg,var(--green),var(--green-lt));
            padding:13px 14px;
            display:flex;align-items:center;gap:10px;
        }
        .bot-avatar{
            width:38px;height:38px;border-radius:50%;
            background:rgba(255,255,255,.15);
            display:flex;align-items:center;justify-content:center;
            font-size:1.1rem;color:#fff;
            border:2px solid rgba(255,255,255,.4);
        }
        .bot-title{font-size:.9rem;font-weight:700;color:#fff}
        .bot-status{font-size:.68rem;color:#c8e6c9;margin-top:1px;display:flex;align-items:center;gap:4px}
        .bot-close{margin-left:auto;background:none;border:none;color:#fff;cursor:pointer;font-size:1.1rem;opacity:.7}
        .bot-close:hover{opacity:1}
        .bot-messages{
            flex:1;overflow-y:auto;padding:14px;
            display:flex;flex-direction:column;gap:10px;
            scrollbar-width:thin;scrollbar-color:#a5d6a7 transparent;
            background:#f9fdf9;
        }
        .bot-msg{
            max-width:88%;padding:9px 13px;
            border-radius:10px;font-size:.83rem;line-height:1.55;
            animation:msgIn .2s ease;
        }
        @@keyframes msgIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
        .bot-msg.bot{
            background:#e8f5e9;color:var(--text);
            border-radius:10px 10px 10px 0;
            align-self:flex-start;
            border:1px solid var(--green-bdr);
        }
        .bot-msg.user{
            background:var(--green);color:#fff;
            border-radius:10px 10px 0 10px;
            align-self:flex-end;font-weight:600;
        }
        .bot-options{display:flex;flex-direction:column;gap:6px;margin-top:2px}
        .bot-opt{
            background:var(--white);
            border:1.5px solid var(--green-bdr);
            color:var(--green);
            padding:8px 12px;border-radius:6px;
            font-size:.8rem;font-weight:600;
            cursor:pointer;text-align:left;
            transition:all .15s;
            display:flex;align-items:center;gap:8px;
            font-family:'Hind Siliguri',Arial,sans-serif;
        }
        .bot-opt:hover{background:var(--green);color:#fff;border-color:var(--green)}
        .bot-opt i{width:14px;text-align:center}
        .bot-typing{display:flex;gap:4px;align-items:center;padding:4px 2px}
        .bot-typing span{width:7px;height:7px;border-radius:50%;background:var(--green-lt);animation:dot .9s infinite}
        .bot-typing span:nth-child(2){animation-delay:.15s}
        .bot-typing span:nth-child(3){animation-delay:.3s}
        @@keyframes dot{0%,100%{opacity:.3;transform:scale(.8)}50%{opacity:1;transform:scale(1)}}

        /* ── RESPONSIVE ── */
        @@media(max-width:768px){
            .site-name{font-size:.95rem}
            .topbar-inner{padding:10px 12px}
            .nav-inner a{padding:11px 13px;font-size:.78rem}
            table{font-size:.8rem}
            td,thead th{padding:7px 7px}
            .main{padding:12px 8px 40px}
            #bot-panel{width:calc(100vw - 32px);right:16px}
            #bot-btn{bottom:16px;right:16px}
        }
        @@media(max-width:480px){
            .nav-inner a span{display:none}
            .sec-header h2 .label-bn{display:none}
        }
    </style>
    @stack('head')
</head>
<body>

{{-- TOPBAR --}}
<header class="topbar">
    <div class="topbar-inner">
        <div class="logo-wrap">
            @if($setting->logo)
            <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}">
            @else
            <div class="logo-mark">9X</div>
            @endif
            <div>
                <div class="site-name">{{ $setting->site_name }}</div>
                <div class="site-tagline">অফিসিয়াল ভেরিফাইড এজেন্ট লিস্ট</div>
            </div>
        </div>
        <span class="badge-live"><i class="fas fa-circle" style="font-size:.4rem"></i> লাইভ</span>
    </div>
</header>

{{-- TICKER --}}
@if($setting->notice)
<div class="ticker">
    <div class="ticker-label"><i class="fas fa-bullhorn"></i>&nbsp; নোটিশ</div>
    <div class="ticker-scroll">
        <span class="ticker-text">{{ $setting->notice }}&emsp;&emsp;&emsp;❖&emsp;&emsp;&emsp;{{ $setting->notice }}&emsp;&emsp;&emsp;❖&emsp;&emsp;&emsp;{{ $setting->notice }}</span>
    </div>
</div>
@endif

{{-- NAVBAR --}}
<nav class="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-house"></i> <span>হোম</span>
        </a>
        <a href="{{ route('super-agent') }}" class="{{ request()->routeIs('super-agent') ? 'active' : '' }}">
            <i class="fas fa-crown"></i> <span>সুপার এজেন্ট</span>
        </a>
        <a href="{{ route('agent') }}" class="{{ request()->routeIs('agent') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i> <span>এজেন্ট</span>
        </a>
        <a href="{{ route('admin-list') }}" class="{{ request()->routeIs('admin-list') ? 'active' : '' }}">
            <i class="fas fa-shield-halved"></i> <span>এডমিন</span>
        </a>
        <a href="{{ route('customer-service') }}" class="{{ request()->routeIs('customer-service') ? 'active' : '' }}">
            <i class="fas fa-headset"></i> <span>হেল্পলাইন</span>
        </a>
    </div>
</nav>

{{-- MAIN --}}
<main class="main">
    @yield('content')

    {{-- PARTNER SITES --}}
    @if(isset($partners) && $partners->count())
    <div class="partners">
        <h3><i class="fas fa-handshake"></i> আমাদের পার্টনার সাইট</h3>
        <div class="partner-list">
            @foreach($partners as $p)
            <a href="{{ $p->url }}" target="_blank" rel="nofollow noopener"
               class="partner-link" title="{{ $p->description ?? $p->name }}">
                <i class="fas fa-external-link-alt"></i> {{ $p->name }}
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- FAQ --}}
    <div class="faq">
        <h3><i class="fas fa-circle-question"></i> প্রায়শই জিজ্ঞাসিত প্রশ্ন (FAQ)</h3>
        <div class="faq-item">
            <div class="faq-q">৯এক্সবেট একাউন্ট কিভাবে খুলব? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">উপরের লিস্ট থেকে যেকোনো ভেরিফাইড এজেন্টের হোয়াটসঅ্যাপে মেসেজ দিন। এই লিস্টে থাকা এজেন্টরাই শুধুমাত্র অফিসিয়ালভাবে স্বীকৃত।</div>
        </div>
        <div class="faq-item">
            <div class="faq-q">লেনদেন কি নিরাপদ? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">হ্যাঁ। এই লিস্টে থাকা সকল এজেন্ট ৯এক্সবেট কর্তৃক অফিসিয়ালি ভেরিফাইড। অপরিচিত বা এই লিস্টের বাইরে কারো সাথে লেনদেন করবেন না।</div>
        </div>
        <div class="faq-item">
            <div class="faq-q">ডিপোজিট ও উইথড্র কিভাবে করব? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">আপনার এজেন্টকে হোয়াটসঅ্যাপে একাউন্ট আইডি ও পরিমাণ জানান। সাধারণত ৫–১০ মিনিটের মধ্যে লেনদেন সম্পন্ন হয়।</div>
        </div>
        <div class="faq-item">
            <div class="faq-q">অভিযোগ জানাতে কার সাথে যোগাযোগ করব? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">হেল্পলাইন সেকশনে গিয়ে কাস্টমার সার্ভিস নম্বরে যোগাযোগ করুন। অথবা নিচের সহায়তা বট ব্যবহার করুন।</div>
        </div>
        <div class="faq-item">
            <div class="faq-q">সুপার এজেন্ট ও এজেন্টের মধ্যে পার্থক্য কী? <i class="fas fa-chevron-down"></i></div>
            <div class="faq-a">সুপার এজেন্ট একাধিক এজেন্ট পরিচালনা করেন। নতুন একাউন্ট খুলতে সরাসরি এজেন্টের সাথে যোগাযোগ করুন।</div>
        </div>
    </div>

    <div class="disclaimer">
        <strong>দাবিত্যাগ (Disclaimer):</strong> এটি বাংলাদেশের অফিসিয়াল ৯এক্সবেট এজেন্ট লিস্ট। এখানে তালিকাভুক্ত সকল এজেন্ট ভেরিফাইড ও অনুমোদিত। ভুয়া এজেন্ট থেকে সাবধান থাকুন। যেকোনো লেনদেনের আগে এজেন্টের আইডি যাচাই করুন।
    </div>
</main>

<footer>
    @if($socials->count())
    <div class="footer-socials">
        @foreach($socials as $social)
        <a href="{{ $social->url }}" target="_blank" rel="nofollow noopener" title="{{ $social->platform }}">
            <i class="{{ $social->icon }}"></i>
        </a>
        @endforeach
    </div>
    @endif
    <hr class="footer-divider">
    <p class="footer-text">&copy; {{ date('Y') }} <strong>{{ $setting->site_name }}</strong> — অফিসিয়াল এজেন্ট ডিরেক্টরি</p>
    <p class="footer-text" style="margin-top:5px">
        সর্বশেষ আপডেট: {{ \App\Models\Agent::latest('updated_at')->value('updated_at')?->format('d M Y') ?? date('d M Y') }}
    </p>
</footer>

{{-- SMART BOT --}}
<button id="bot-btn" onclick="toggleBot()" title="৯এক্সবেট সহায়তা বট">
    <span id="bot-icon"><i class="fas fa-robot"></i></span>
    <span class="bot-notif" id="bot-notif">1</span>
</button>

<div id="bot-panel">
    <div class="bot-head">
        <div class="bot-avatar"><i class="fas fa-robot"></i></div>
        <div>
            <div class="bot-title">৯এক্সবেট সহায়তা</div>
            <div class="bot-status"><i class="fas fa-circle" style="font-size:.4rem;color:#a5d6a7"></i> অনলাইন</div>
        </div>
        <button class="bot-close" onclick="toggleBot()"><i class="fas fa-xmark"></i></button>
    </div>
    <div class="bot-messages" id="bot-messages"></div>
</div>

<script>
const BOT = {
    open:false, started:false,
    msgs: document.getElementById('bot-messages'),

    send(text, type='bot', delay=0){
        setTimeout(()=>{
            const d=document.createElement('div');
            d.className='bot-msg '+type;
            d.textContent=text;
            this.msgs.appendChild(d);
            this.msgs.scrollTop=9999;
        }, delay);
    },

    typing(delay=0){
        return new Promise(res=>{
            setTimeout(()=>{
                const d=document.createElement('div');
                d.className='bot-msg bot';
                d.innerHTML='<div class="bot-typing"><span></span><span></span><span></span></div>';
                d.id='bot-typing';
                this.msgs.appendChild(d);
                this.msgs.scrollTop=9999;
                setTimeout(()=>{d.remove();res();},900);
            },delay);
        });
    },

    options(items,delay=0){
        setTimeout(()=>{
            const wrap=document.createElement('div');
            wrap.className='bot-options';
            items.forEach(item=>{
                const b=document.createElement('button');
                b.className='bot-opt';
                b.innerHTML=item.html;
                b.onclick=()=>{wrap.remove();item.action();};
                wrap.appendChild(b);
            });
            this.msgs.appendChild(wrap);
            this.msgs.scrollTop=9999;
        },delay);
    },

    mainMenu(){
        this.options([
            {html:'<i class="fas fa-user-plus"></i> নতুন একাউন্ট খুলতে চাই',    action:()=>this.openAccount()},
            {html:'<i class="fas fa-magnifying-glass"></i> এজেন্ট খুঁজছি',        action:()=>this.findAgent()},
            {html:'<i class="fas fa-money-bill-transfer"></i> ডিপোজিট / উইথড্র', action:()=>this.deposit()},
            {html:'<i class="fas fa-headset"></i> অভিযোগ / হেল্পলাইন',           action:()=>this.complaint()},
        ],100);
    },

    async openAccount(){
        this.send('নতুন একাউন্ট খুলতে চাই','user');
        await this.typing(200);
        this.send('একাউন্ট খুলতে যেকোনো ভেরিফাইড এজেন্টের হোয়াটসঅ্যাপে মেসেজ দিন। নিচে এজেন্ট লিস্ট দেখুন।','bot',900);
        this.options([
            {html:'<i class="fas fa-user-tie"></i> এজেন্ট লিস্ট দেখুন',       action:()=>{location.href='/agent';}},
            {html:'<i class="fas fa-crown"></i> সুপার এজেন্ট লিস্ট',           action:()=>{location.href='/super-agent';}},
            {html:'<i class="fas fa-rotate-left"></i> মেনুতে ফিরে যান',        action:()=>this.mainMenu()},
        ],1100);
    },

    async findAgent(){
        this.send('এজেন্ট খুঁজছি','user');
        await this.typing(200);
        this.send('কোন ধরনের এজেন্ট খুঁজছেন?','bot',900);
        this.options([
            {html:'<i class="fas fa-user-tie"></i> সাধারণ এজেন্ট',             action:()=>{location.href='/agent';}},
            {html:'<i class="fas fa-crown"></i> সুপার এজেন্ট',                 action:()=>{location.href='/super-agent';}},
            {html:'<i class="fas fa-shield-halved"></i> এডমিন',                action:()=>{location.href='/admin-list';}},
            {html:'<i class="fas fa-rotate-left"></i> মেনুতে ফিরে যান',        action:()=>this.mainMenu()},
        ],1100);
    },

    async deposit(){
        this.send('ডিপোজিট / উইথড্র সহায়তা','user');
        await this.typing(200);
        this.send('ডিপোজিট বা উইথড্রের জন্য আপনার এজেন্টকে হোয়াটসঅ্যাপে একাউন্ট আইডি ও পরিমাণ জানান। সাধারণত ৫-১০ মিনিটে সম্পন্ন হয়।','bot',900);
        this.options([
            {html:'<i class="fas fa-user-tie"></i> আমার এজেন্ট খুঁজুন',       action:()=>{location.href='/agent';}},
            {html:'<i class="fas fa-rotate-left"></i> মেনুতে ফিরে যান',        action:()=>this.mainMenu()},
        ],1100);
    },

    async complaint(){
        this.send('অভিযোগ / হেল্পলাইন','user');
        await this.typing(200);
        this.send('অভিযোগের জন্য আমাদের কাস্টমার সার্ভিস টিমের সাথে হোয়াটসঅ্যাপে যোগাযোগ করুন।','bot',900);
        this.options([
            {html:'<i class="fas fa-headset"></i> হেল্পলাইন দেখুন',           action:()=>{location.href='/customer-service';}},
            {html:'<i class="fas fa-rotate-left"></i> মেনুতে ফিরে যান',        action:()=>this.mainMenu()},
        ],1100);
    },

    start(){
        if(this.started)return;
        this.started=true;
        document.getElementById('bot-notif').style.display='none';
        this.send('👋 আসসালামু আলাইকুম! আমি ৯এক্সবেট সহায়তা বট।','bot',300);
        this.send('আপনাকে কিভাবে সাহায্য করতে পারি?','bot',900);
        this.mainMenu();
    }
};

function toggleBot(){
    BOT.open=!BOT.open;
    const panel=document.getElementById('bot-panel');
    const icon=document.getElementById('bot-icon');
    if(BOT.open){panel.classList.add('open');icon.innerHTML='<i class="fas fa-xmark"></i>';BOT.start();}
    else{panel.classList.remove('open');icon.innerHTML='<i class="fas fa-robot"></i>';}
}

document.querySelectorAll('.faq-item').forEach(el=>{
    el.addEventListener('click',()=>el.classList.toggle('open'));
});

function shuffleTable(btn){
    const header=btn.closest('.sec-header');
    const wrap=header.nextElementSibling;
    if(!wrap)return;
    const tbody=wrap.querySelector('tbody');
    if(!tbody)return;
    const rows=Array.from(tbody.querySelectorAll('tr'));
    for(let i=rows.length-1;i>0;i--){
        const j=Math.floor(Math.random()*(i+1));
        tbody.insertBefore(rows[j],rows[i].nextSibling);
        [rows[i],rows[j]]=[rows[j],rows[i]];
    }
    tbody.querySelectorAll('tr').forEach((tr,idx)=>{
        const num=tr.querySelector('.td-num');
        if(num)num.textContent=idx+1;
    });
    btn.classList.add('spinning');
    setTimeout(()=>btn.classList.remove('spinning'),500);
}
</script>

@stack('scripts')
</body>
</html>
