<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title> @yield('title')e | Clerk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #000000;
            --bg-card: #0A0A0A;
            --bg-off: #111111;
            --text: #FFFFFF;
            --text-sub: #777777;
            --accent: #00FF88;
            --border: #1A1A1A;
            --sidebar-width: 260px;
            --safe-bottom: env(safe-area-inset-bottom);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            overscroll-behavior-y: contain;
        }

        /* ═══════════════════════════════════════════
           LAYOUT STRUCTURE
        ═══════════════════════════════════════════ */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* ═══════════════════════════════════════════
           SIDEBAR / BOTTOM DOCK
        ═══════════════════════════════════════════ */
        .navigation {
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            width: var(--sidebar-width);
            height: 100vh;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            padding: 32px 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 800;
            padding: 0 24px 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 24px;
            color: var(--text-sub);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        .nav-item.active {
            color: var(--accent);
            background: rgba(0, 255, 136, 0.05);
            border-right: 2px solid var(--accent);
        }

        /* ═══════════════════════════════════════════
           MAIN WORKSPACE
        ═══════════════════════════════════════════ */
        .workspace {
            flex: 1;
            width: 100%;
            min-width: 0; 
        }

        .header {
            height: 72px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .role-switcher {
            background: var(--bg-off);
            border: 1px solid var(--border);
            padding: 4px;
            border-radius: 12px;
            display: flex;
        }

        .role-btn {
            background: transparent;
            border: none;
            color: var(--text-sub);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }

        .role-btn.active {
            background: var(--accent);
            color: #000;
        }

        /* Main Content */
        .content {
            padding: 40px 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-view {
            display: none;
        }

        .page-view.active {
            display: block;
        }

        .section-header {
            margin-bottom: 24px;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 24px;
            margin-bottom: 4px;
        }

        .section-tag {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--accent);
            text-transform: uppercase;
        }

        /* Grid Cards */
        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 48px;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 16px;
        }

        .card-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-sub);
            text-transform: uppercase;
            display: block;
            margin-bottom: 8px;
        }

        .card-value {
            font-size: 28px;
            font-weight: 800;
            font-family: 'Syne', sans-serif;
        }

        /* Actions Mobile-Scroll */
        .action-strip {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 12px;
            margin-bottom: 48px;
            scrollbar-width: none;
        }

        .action-strip::-webkit-scrollbar { display: none; }

        .btn-action {
            flex: 0 0 auto;
            background: var(--bg-off);
            border: 1px solid var(--border);
            padding: 16px 24px;
            border-radius: 12px;
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 180px;
        }

        /* Responsive Table to Cards */
        .transaction-list {
            display: flex;
            flex-direction: column;
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .trx-item {
            background: var(--bg-card);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .trx-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .trx-title { font-weight: 600; font-size: 15px; }
        .trx-meta { font-family: 'Space Mono'; font-size: 11px; color: var(--text-sub); }

        .trx-amount {
            text-align: right;
        }

        .amount-val { font-family: 'Space Mono'; font-weight: 700; font-size: 15px; display: block; }
        .status-pill {
            font-size: 9px;
            text-transform: uppercase;
            padding: 2px 6px;
            border: 1px solid var(--accent);
            color: var(--accent);
            border-radius: 4px;
        }

        /* ═══════════════════════════════════════════
           MOBILE OVERRIDES (CRITICAL)
        ═══════════════════════════════════════════ */
        @media (max-width: 850px) {
            .app-container {
                flex-direction: column;
            }

            .navigation {
                position: fixed;
                bottom: 0;
                top: auto;
                width: 100%;
                height: calc(70px + var(--safe-bottom));
                flex-direction: row;
                padding: 0 10px var(--safe-bottom);
                border-right: none;
                border-top: 1px solid var(--border);
                background: rgba(10, 10, 10, 0.95);
                backdrop-filter: blur(15px);
            }

            .logo { display: none; }

            .nav-links {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
                align-items: center;
            }

            .nav-item {
                flex-direction: column;
                padding: 10px;
                font-size: 10px;
                gap: 4px;
                border-right: none;
                border-bottom: 2px solid transparent;
                flex: 1;
            }

            .nav-item.active {
                border-right: none;
                border-bottom-color: var(--accent);
            }

            .nav-icon { font-size: 20px; }

            .header {
                padding: 0 16px;
            }

            .content {
                padding: 24px 16px 100px 16px;
            }

            .grid-layout {
                grid-template-columns: 1fr;
            }

            .card-value {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Responsive Nav -->
        <nav class="navigation">
            <div class="logo">CLERK</div>
            <div class="nav-links">
                <a href="#" class="nav-item active">
                    <span class="nav-icon">▤</span>
                    <span>Panel</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">⇅</span>
                    <span>Logs</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">⚙</span>
                    <span>Tools</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">👤</span>
                    <span>Account</span>
                </a>
            </div>
        </nav>

        <div class="workspace">
            <header class="header">
                <div id="route-tag" class="section-tag">/terminal/agent</div>
                <div class="role-switcher">
                    <button class="role-btn" data-view="merchant" onclick="navigateTo(this)">Merchant</button>
                    <button class="role-btn active" data-view="agent" onclick="navigateTo(this)">Agent</button>
                </div>
            </header>

            
            @yield('main')
        </div>
    </div>

    <script>
        function navigateTo(btn) {
            const viewId = btn.getAttribute('data-view');
            
            // 1. Update Buttons
            document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // 2. Switch Page Views
            document.querySelectorAll('.page-view').forEach(view => view.classList.remove('active'));
            document.getElementById(viewId + '-view').classList.add('active');

            // 3. Update Header Tag
            document.getElementById('route-tag').innerText = `/terminal/${viewId}`;
            
            // Scroll to top on view change
            window.scrollTo(0, 0);
        }
    </script>
</body>
</html>