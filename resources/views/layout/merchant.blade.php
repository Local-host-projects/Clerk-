<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — @yield('title')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
  <style>
/* ═══════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════ */
[data-theme="dark"] {
  --bg:         #080808;
  --bg-off:     #0F0F0F;
  --bg-card:    #111111;
  --bg-hover:   #151515;
  --bg-input:   #0C0C0C;
  --border:     #1C1C1C;
  --border-mid: #282828;
  --border-hi:  #363636;
  --text:       #EEECEA;
  --text-sub:   #484844;
  --accent:     #00E676;
  --accent-h:   #00FF88;
  --red:        #FF4B4B;
  --btn-fg:     #080808;
  --grain:      0.028;
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{
  background:var(--bg);color:var(--text);
  font-family:'Syne',sans-serif;
  height:100vh;overflow:hidden;
  display:flex;flex-direction:column;
}

body::after{
  content:'';position:fixed;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity:var(--grain);pointer-events:none;z-index:9999;
}

/* ═══════════════════════════════════════════
   TOPBAR
═══════════════════════════════════════════ */
.topbar{
  height:56px; border-bottom:1px solid var(--border);
  display:flex; align-items:center; justify-content:space-between;
  padding:0 24px; background:var(--bg); z-index:50;
}
.wordmark{font-weight:800; font-size:16px; letter-spacing:.14em; text-decoration:none; color:var(--text)}
.wordmark span{color:var(--accent)}

/* Role Toggle */
.role-toggle {
  display: flex;
  background: var(--bg-card);
  border: 1px solid var(--border);
  padding: 3px;
  border-radius: 100px;
  gap: 2px;
}
.role-btn {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 6px 14px;
  border-radius: 100px;
  text-decoration: none;
  color: var(--text-sub);
  transition: all 0.2s ease;
}
.role-btn:hover {
  color: var(--text);
}
.role-btn.active {
  background: var(--accent);
  color: var(--btn-fg);
}

/* ═══════════════════════════════════════════
   APP SHELL
═══════════════════════════════════════════ */
.app-shell{ flex:1; display:grid; grid-template-columns:220px 1fr; overflow:hidden; }

/* ═══════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════ */
.sidebar{ border-right:1px solid var(--border); display:flex; flex-direction:column; background:var(--bg); padding-top: 10px;}
.nav-item{
  display:flex; align-items:center; gap:12px; padding:12px 20px;
  cursor:pointer; border-left:2px solid transparent; transition:all .15s;
  font-size:12px; font-weight:700; color:var(--text-sub); text-decoration: none;
}
.nav-item:hover{ background:var(--bg-off); color:var(--text); }
.nav-item.active{ border-left-color:var(--accent); background:var(--bg-off); color:var(--text); }

/* ═══════════════════════════════════════════
   MAIN CONTENT
═══════════════════════════════════════════ */

/* Projects Table */

  </style>
  @stack('styles')
</head>
<body>

<header class="topbar">
  <a href="#" class="wordmark">CLR<span>K</span> — CONSOLE</a>
  @php
      $db = 'merchant';
  @endphp

  <div class="role-toggle">
    <!-- Update these href values to your actual routes -->
    <a href="{{ route('merchant.dashboard') }}" class="role-btn @if($db == 'merchant') active @endif">Merchant</a>
    <a href="{{route('agent.panel')}}" class="role-btn @if($db == 'agent') active @endif">Agent</a>
  </div>
</header>

<div class="app-shell">
  <nav class="sidebar">
    <a href="{{route('merchant.dashboard')}}" class="nav-item @if($page == 'dashboard') active @endif">Dashboard</a>
    <a href="{{route('merchant.products')}}" class="nav-item @if($page == 'products') active @endif">Products</a>
    <a href="#" class="nav-item">Profile</a>
    <a href="#" class="nav-item">Settings</a>
  </nav>
  @yield('main')
</div>
@yield('modal')

@stack('scripts')

</body>
</html>