@extends('layout.auth')

@push('navigateTo')
    <a href="{{ route('auth.login') }}" class="top-link">Login →</a>
@endpush

@section('title', 'Create Your Account')

@push('styles')
    <style>
        [data-theme="dark"] {
            --bg: #080808;
            --bg-off: #0F0F0F;
            --bg-card: #111111;
            --border: #1C1C1C;
            --border-md: #282828;
            --border-hi: #383838;
            --text: #EEECEA;
            --text-sub: #484844;
            --text-dim: #242420;
            --accent: #00E676;
            --accent-d: #003D1F;
            --accent-h: #00FF88;
            --btn-fg: #080808;
            --red: #FF4040;
            --red-d: #280A0A;
            --amber: #F5A200;
            --amber-d: #281E00;
            --input-bg: #0C0C0C;
            --grain: 0.028;
        }

        [data-theme="light"] {
            --bg: #F2F1ED;
            --bg-off: #EAEAE4;
            --bg-card: #E6E5E0;
            --border: #D2D0CA;
            --border-md: #BCBBB6;
            --border-hi: #9E9D98;
            --text: #111110;
            --text-sub: #888884;
            --text-dim: #CCCBCB;
            --accent: #007A38;
            --accent-d: #D4EDDA;
            --accent-h: #009444;
            --btn-fg: #FFFFFF;
            --red: #CC2020;
            --red-d: #FDECEA;
            --amber: #B45309;
            --amber-d: #FEF3C7;
            --input-bg: #F7F6F2;
            --grain: 0.010;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Syne', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background .2s, color .2s;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
            opacity: var(--grain);
            pointer-events: none;
        }

        .bg-glow {
            position: fixed;
            top: -80px;
            left: -80px;
            z-index: 0;
            width: 440px;
            height: 440px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--accent-d) 0%, transparent 65%);
            pointer-events: none;
            animation: gl 9s ease-in-out infinite;
        }

        @keyframes gl {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
                opacity: .5;
            }

            50% {
                transform: translate(20px, 20px) scale(1.1);
                opacity: .9;
            }
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 56px 56px;
            opacity: .45;
            pointer-events: none;
        }

        .topbar {
            position: relative;
            z-index: 10;
            border-bottom: 1px solid var(--border);
            height: 56px;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(8, 8, 8, .7);
            backdrop-filter: blur(12px);
            transition: background .2s, border-color .2s;
        }

        [data-theme="light"] .topbar {
            background: rgba(242, 241, 237, .8);
        }

        .wordmark {
            font-weight: 800;
            font-size: 17px;
            letter-spacing: .14em;
            color: var(--text);
            text-decoration: none;
        }

        .wordmark span {
            color: var(--accent);
        }

        .topbar-r {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-link {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-sub);
            letter-spacing: .08em;
            text-decoration: none;
            transition: color .15s;
        }

        .top-link:hover {
            color: var(--text);
        }

        .theme-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-sub);
            transition: all .15s;
        }

        .theme-btn:hover {
            border-color: var(--border-md);
            color: var(--text);
            background: var(--bg-off);
        }

        .theme-btn svg {
            width: 13px;
            height: 13px;
        }

        .page {
            flex: 1;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 520px 1fr;
            max-width: 1120px;
            margin: 0 auto;
            width: 100%;
        }

        .right-brand {
            padding: 72px 64px 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 1px solid var(--border);
            order: 2;
            transition: border-color .2s;
        }

        .brand-tag {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--accent);
            letter-spacing: .14em;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fu .5s .1s both;
        }

        .brand-tag::before {
            content: '';
            display: inline-block;
            width: 18px;
            height: 1px;
            background: var(--accent);
        }

        .brand-h {
            font-size: clamp(34px, 4vw, 54px);
            font-weight: 800;
            letter-spacing: -.03em;
            line-height: .97;
            margin-bottom: 24px;
            animation: fu .5s .18s both;
        }

        .brand-h .ac {
            color: var(--accent);
        }

        .brand-p {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: var(--text-sub);
            line-height: 1.82;
            max-width: 340px;
            animation: fu .5s .26s both;
        }

        .step-track {
            display: flex;
            flex-direction: column;
            gap: 1px;
            margin-top: 36px;
            animation: fu .5s .34s both;
        }

        .st-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 16px;
            border: 1px solid var(--border);
            transition: border-color .2s, background .2s;
        }

        .st-item.active {
            border-color: var(--accent-d);
            background: var(--accent-d);
        }

        .st-item.done {
            border-color: var(--border);
            background: var(--bg-off);
        }

        .st-num {
            width: 22px;
            height: 22px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-dim);
            flex-shrink: 0;
            transition: all .2s;
        }

        .st-item.active .st-num {
            border-color: var(--accent);
            color: var(--accent);
        }

        .st-item.done .st-num {
            border-color: var(--accent);
            background: var(--accent);
            color: var(--btn-fg);
        }

        .st-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-sub);
            letter-spacing: .06em;
            transition: color .2s;
        }

        .st-item.active .st-label {
            color: var(--accent);
        }

        .st-item.done .st-label {
            color: var(--text-sub);
        }

        .brand-bot {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 28px;
            border-top: 1px solid var(--border);
            animation: fu .5s .42s both;
            transition: border-color .2s;
        }

        .bpip {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: pip 1.4s ease-in-out infinite;
        }

        @keyframes pip {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .2;
            }
        }

        .btxt {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-sub);
            letter-spacing: .06em;
        }

        .btxt strong {
            color: var(--text);
        }

        .left-form {
            padding: 52px 52px 48px;
            display: flex;
            flex-direction: column;
            order: 1;
            background: var(--bg);
            transition: background .2s;
            overflow-y: auto;
        }

        .step-screen {
            display: none;
            flex-direction: column;
            flex: 1;
            animation: fu .3s both;
        }

        .step-screen.active {
            display: flex;
        }

        .sc-eyebrow {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--accent);
            letter-spacing: .12em;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sc-eyebrow::before {
            content: '';
            display: inline-block;
            width: 14px;
            height: 1px;
            background: var(--accent);
        }

        .sc-title {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -.025em;
            line-height: 1.05;
            margin-bottom: 6px;
        }

        .sc-sub {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: var(--text-sub);
            margin-bottom: 28px;
            line-height: 1.65;
        }

        .fields {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .fg {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .frow {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .flbl {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-sub);
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .fwrap {
            border: 1px solid var(--border);
            background: var(--input-bg);
            display: flex;
            align-items: stretch;
            transition: border-color .15s, background .2s;
        }

        .fwrap:focus-within {
            border-color: var(--border-hi);
        }

        .fwrap.e {
            border-color: var(--red);
        }

        .fwrap.ok {
            border-color: var(--accent);
        }

        .fic {
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px solid var(--border);
            flex-shrink: 0;
        }

        .fic svg {
            width: 12px;
            height: 12px;
            stroke: var(--text-sub);
            fill: none;
            transition: stroke .15s;
        }

        .fwrap:focus-within .fic svg {
            stroke: var(--text);
        }

        .fwrap input,
        .fwrap select {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            padding: 12px 12px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: var(--text);
            letter-spacing: .04em;
        }

        .fwrap input::placeholder {
            color: var(--text-dim);
        }

        .fwrap select {
            cursor: pointer;
            appearance: none;
        }

        .fwrap select option {
            background: var(--bg-card);
        }

        .peye {
            width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-left: 1px solid var(--border);
            cursor: pointer;
            background: transparent;
            border-top: none;
            border-right: none;
            border-bottom: none;
            color: var(--text-sub);
            transition: color .15s;
        }

        .peye:hover {
            color: var(--text);
        }

        .peye svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            fill: none;
        }

        .ferr {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--red);
            letter-spacing: .06em;
            display: none;
            margin-top: -4px;
        }

        .ferr.show {
            display: block;
        }

        .pw-strength {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: -6px;
        }

        .pw-bars {
            display: flex;
            gap: 3px;
        }

        .pw-bar {
            flex: 1;
            height: 2px;
            background: var(--border);
            transition: background .3s;
        }

        .pw-bar.w {
            background: var(--red);
        }

        .pw-bar.m {
            background: var(--amber);
        }

        .pw-bar.s {
            background: var(--accent);
        }

        .pw-hint {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-sub);
            letter-spacing: .06em;
        }

        .terms-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 4px;
        }

        .chbox {
            width: 15px;
            height: 15px;
            border: 1px solid var(--border);
            background: var(--input-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            cursor: pointer;
            transition: all .15s;
            margin-top: 1px;
        }

        .chbox.on {
            border-color: var(--accent);
            background: var(--accent);
        }

        .chbox svg {
            width: 9px;
            height: 9px;
            stroke: var(--btn-fg);
            fill: none;
            display: none;
        }

        .chbox.on svg {
            display: block;
        }

        .terms-txt {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-sub);
            line-height: 1.6;
            letter-spacing: .04em;
        }

        .terms-txt a {
            color: var(--accent);
            text-decoration: none;
        }

        .sbtn {
            width: 100%;
            background: var(--accent);
            color: var(--btn-fg);
            border: none;
            padding: 16px 24px;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: .12em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background .15s;
            margin-top: 24px;
            position: relative;
            overflow: hidden;
        }

        .sbtn:hover:not(:disabled) {
            background: var(--accent-h);
        }

        .sbtn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .sbtn .arr {
            font-size: 18px;
            font-weight: 400;
        }

        .sbtn.ld::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .18), transparent);
            animation: sh 1.2s ease-in-out infinite;
        }

        @keyframes sh {
            0% {
                left: -60%;
            }

            100% {
                left: 140%;
            }
        }

        .back-btn {
            width: 100%;
            background: transparent;
            color: var(--text-sub);
            border: 1px solid var(--border);
            padding: 13px 18px;
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            letter-spacing: .08em;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all .15s;
            margin-top: 8px;
        }

        .back-btn:hover {
            border-color: var(--border-md);
            color: var(--text);
        }

        .err-box {
            display: none;
            align-items: flex-start;
            gap: 10px;
            border: 1px solid var(--red);
            background: var(--red-d);
            padding: 11px 14px;
            margin-bottom: 16px;
        }

        .err-box.show {
            display: flex;
        }

        .err-icon {
            width: 13px;
            height: 13px;
            stroke: var(--red);
            fill: none;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .err-txt {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--red);
            line-height: 1.65;
            letter-spacing: .04em;
        }

        .success-mark {
            width: 64px;
            height: 64px;
            border: 2px solid var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            animation: pop .5s cubic-bezier(.34, 1.56, .64, 1) both;
        }

        @keyframes pop {
            from {
                transform: scale(.4);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-mark svg {
            width: 28px;
            height: 28px;
            stroke: var(--accent);
            fill: none;
            stroke-dasharray: 40;
            stroke-dashoffset: 40;
            animation: draw .4s .3s ease-out forwards;
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0;
            }
        }

        .ffoot {
            padding-top: 24px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: border-color .2s;
        }

        .ftxt {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-sub);
            letter-spacing: .05em;
        }

        .flink {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--accent);
            letter-spacing: .06em;
            text-decoration: none;
            border-bottom: 1px solid var(--accent-d);
            padding-bottom: 2px;
            transition: border-color .15s;
        }

        .flink:hover {
            border-color: var(--accent);
        }

        @keyframes fu {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width:860px) {
            .page {
                grid-template-columns: 1fr;
            }

            .right-brand {
                display: none;
            }

            .left-form {
                padding: 48px 28px 40px;
                min-height: calc(100vh - 56px);
            }
        }
    </style>
@endpush

@section('main')
    <div class="page">

        <!-- FORM (left) -->
        <form action="{{ route('auth.register.store') }}" method='post'>
        @csrf
            <main class="left-form">
    
                <div class="step-screen active" id="s1">
                    <p class="sc-eyebrow">Step 1 of 2</p>
                    <h2 class="sc-title">Your details.</h2>
                    <p class="sc-sub">Tell us a bit about yourself to set up your account.</p>
    
                    <div class="err-box" id="eb1">
                        <svg class="err-icon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <span class="err-txt" id="et1">Please fill all required fields.</span>
                    </div>
    
                    <div class="fields">
                        <div class="fg">
                            <div class="frow">
                                <label class="flbl" for="fn">First Name *</label>
                                <div class="fwrap" id="fnw">
                                    <div class="fic">
                                        <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </div>
                                    <input type="text" name='firstname' value="{{ old('firstname') }}" id="fn" placeholder="Emeka" autocomplete="given-name" />
                                </div>
                                <span class="ferr" id="fne">Required</span>
                            </div>
                            <div class="frow">
                                <label class="flbl" for="ln">Last Name *</label>
                                <div class="fwrap" id="lnw">
                                    <div class="fic">
                                        <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </div>
                                    <input type="text" name="lastname" value="{{ old('lastname') }}" id="ln" placeholder="Obi" autocomplete="family-name" />
                                </div>
                                <span class="ferr" id="lne">Required</span>
                            </div>
                        </div>
    
                        <div class="frow">
                            <label class="flbl" for="ema">Email Address *</label>
                            <div class="fwrap" id="emaw">
                                <div class="fic">
                                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                        <polyline points="22,6 12,13 2,6" />
                                    </svg>
                                </div>
                                <input type="email" id="ema" name="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email"
                                    oninput="clErr()" />
                            </div>
                            <span class="ferr" id="emae">Enter a valid email address.</span>
                        </div>
                        <div class="frow">
                            <label class="flbl" for="pw1">Password *</label>
                            <div class="fwrap" id="pw1w">
                                <div class="fic">
                                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                        <rect x="3" y="11" width="18" height="11" />
                                        <path d="M7 11V7a5 5 0 0110 0v4" />
                                    </svg>
                                </div>
                                <input type="password" name="password" id="pw1" placeholder="Min. 8 characters" oninput="checkPw()" />
                                <button class="peye" onclick="tPw1()" type="button">
                                    <svg id="pe1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                        <path
                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <div class="pw-strength" id="pws">
                                <div class="pw-bars">
                                    <div class="pw-bar" id="pb0"></div>
                                    <div class="pw-bar" id="pb1"></div>
                                    <div class="pw-bar" id="pb2"></div>
                                    <div class="pw-bar" id="pb3"></div>
                                </div>
                                <span class="pw-hint" id="pwhint">Enter a password to check strength</span>
                            </div>
                            <span class="ferr" id="pw1e">Password must be at least 8 characters.</span>
                        </div>
    
                        <div class="frow">
                            <label class="flbl" for="pw2">Confirm Password *</label>
                            <div class="fwrap" id="pw2w">
                                <div class="fic">
                                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                        <rect x="3" y="11" width="18" height="11" />
                                        <path d="M7 11V7a5 5 0 0110 0v4" />
                                    </svg>
                                </div>
                                <input type="password" name="confirm_password" id="pw2" placeholder="Repeat password" oninput="checkMatch()" />
                                <button class="peye" onclick="tPw2()" type="button">
                                    <svg id="pe2" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round">
                                        <path
                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            <span class="ferr" id="pw2e">Passwords do not match.</span>
                        </div>
    
    
                        <!-- Terms -->
                        <div class="terms-row" style="margin-top:4px">
                            <div class="chbox" id="terms-box" onclick="toggleTerms()">
                                <svg viewBox="0 0 12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="2,6 5,9 10,3" />
                                </svg>
                            </div>
                            <div class="terms-txt">I agree to Clerk's <a href="#">Terms of Service</a> and <a href="#">Privacy
                                    Policy</a>. I understand my escrow balance is held by a licensed agent and not a
                                deposit-taking institution.</div>
                        </div>
                        <span class="ferr" id="termse">You must accept the terms to continue.</span>
    
                        
                    </div>
    
                    <button class="sbtn" type="submit">
                        <span>Submit</span>
                    </button>
                    <div class="ffoot" style="margin-top:24px">
                        <span class="ftxt">Already have an account?</span>
                        <a href="{{ route('auth.login') }}" class="flink">Sign in →</a>
                    </div>
                </div>
    
            </main>
        </form>

        <!-- BRAND (right) -->
        <aside class="right-brand">
            <div>
                <p class="brand-tag">Create account</p>
                <h2 class="brand-h">Join the<br>cash-to-online<br><span class="ac">revolution.</span></h2>
                <p class="brand-p">Clerk connects you to a seamless cash-to-online experience. Shop, sell, or serve as a
                    trusted agent.</p>

                <div class="step-track" id="step-track">
                    <div class="st-item active" id="st1">
                        <div class="st-num" id="stn1">1</div>
                        <span class="st-label">Personal details</span>
                    </div>
                    <div class="st-item" id="st2">
                        <div class="st-num" id="stn2">2</div>
                        <span class="st-label">Secure your account</span>
                    </div>
                </div>
            </div>

            <div class="brand-bot">
                <div class="bpip"></div>
                <span class="btxt">All systems <strong>operational</strong> · 41K+ agents</span>
            </div>
        </aside>

    </div>
@endsection

@push('scripts')
    <script>
        let currentStep = 1,
            termsAgreed = false;
        let pv1 = false,
            pv2 = false;

        function nextStep() {
            document.querySelector('.sbtn').preventDefault();
            if (currentStep === 1) {
                if (!validateStep1()) return;
                goStep(2);
            }
        }

        function prevStep() {
            if (currentStep > 1) goStep(currentStep - 1);
        }

        function goStep(n) {
            document.getElementById('s' + currentStep).classList.remove('active');
            currentStep = n;
            document.getElementById('s' + currentStep).classList.add('active');
            updateTracker();
        }

        function updateTracker() {
            [1, 2].forEach(i => {
                const el = document.getElementById('st' + i);
                const nm = document.getElementById('stn' + i);
                el.classList.remove('active', 'done');
                nm.textContent = i;
                if (i < currentStep) {
                    el.classList.add('done');
                    nm.innerHTML = '✓';
                } else if (i === currentStep) el.classList.add('active');
            });
        }

        function validateStep1() {
            let ok = true;
            document.getElementById('eb1').classList.remove('show');

            if (!document.getElementById('fn').value.trim()) {
                document.getElementById('fnw').classList.add('e');
                document.getElementById('fne').classList.add('show');
                ok = false;
            } else {
                document.getElementById('fnw').classList.remove('e');
            }

            if (!document.getElementById('ln').value.trim()) {
                document.getElementById('lnw').classList.add('e');
                document.getElementById('lne').classList.add('show');
                ok = false;
            } else {
                document.getElementById('lnw').classList.remove('e');
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(document.getElementById('ema').value.trim())) {
                document.getElementById('emaw').classList.add('e');
                document.getElementById('emae').classList.add('show');
                ok = false;
            } else {
                document.getElementById('emaw').classList.remove('e');
            }

            if (!document.getElementById('state').value) {
                document.getElementById('statew').classList.add('e');
                document.getElementById('statee').classList.add('show');
                ok = false;
            }

            if (!ok) {
                document.getElementById('eb1').classList.add('show');
                document.getElementById('et1').textContent = 'Please fill all required fields.';
            }
            return ok;
        }

        function clErr() {
            ['emaw', 'statew'].forEach(id => {
                document.getElementById(id)?.classList.remove('e');
            });
            ['emae', 'statee'].forEach(id => {
                document.getElementById(id)?.classList.remove('show');
            });
            document.getElementById('eb1')?.classList.remove('show');
        }

        function checkPw() {
            const pw = document.getElementById('pw1').value;
            const bars = [
                document.getElementById('pb0'),
                document.getElementById('pb1'),
                document.getElementById('pb2'),
                document.getElementById('pb3')
            ];
            const hint = document.getElementById('pwhint');
            bars.forEach(b => {
                b.className = 'pw-bar';
            });
            if (!pw) {
                hint.textContent = 'Enter a password to check strength';
                hint.style.color = 'var(--text-sub)';
                return;
            }
            let score = 0;
            if (pw.length >= 8) score++;
            if (/[A-Z]/.test(pw)) score++;
            if (/[0-9]/.test(pw)) score++;
            if (/[^A-Za-z0-9]/.test(pw)) score++;
            const cls = ['w', 'w', 'm', 's'];
            const labels = ['Too weak', 'Weak', 'Fair', 'Strong'];
            const colors = ['var(--red)', 'var(--red)', 'var(--amber)', 'var(--accent)'];
            for (let i = 0; i < score; i++) bars[i].classList.add(cls[score - 1]);
            hint.textContent = labels[score - 1] || '';
            hint.style.color = colors[score - 1] || '';
        }

        function checkMatch() {
            const match = document.getElementById('pw1').value === document.getElementById('pw2').value;
            document.getElementById('pw2w').classList.toggle('ok', match && document.getElementById('pw2').value.length > 0);
            document.getElementById('pw2w').classList.toggle('e', !match && document.getElementById('pw2').value.length > 0);
            document.getElementById('pw2e').classList.toggle('show', !match && document.getElementById('pw2').value.length > 0);
        }

        function toggleTerms() {
            termsAgreed = !termsAgreed;
            document.getElementById('terms-box').classList.toggle('on', termsAgreed);
            document.getElementById('termse').classList.remove('show');
        }

        function tPw1() {
            pv1 = !pv1;
            document.getElementById('pw1').type = pv1 ? 'text' : 'password';
            document.getElementById('pe1').innerHTML = pv1 ?
                `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>` :
                `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }

        function tPw2() {
            pv2 = !pv2;
            document.getElementById('pw2').type = pv2 ? 'text' : 'password';
            document.getElementById('pe2').innerHTML = pv2 ?
                `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>` :
                `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }

        function toggleTheme() {
            const h = document.documentElement;
            h.dataset.theme = h.dataset.theme === 'dark' ? 'light' : 'dark';
            si();
        }

        function si() {
            const d = document.documentElement.dataset.theme === 'dark';
            document.getElementById('ti').innerHTML = d ?
                `<path d="M12 17a5 5 0 100-10 5 5 0 000 10zm0-13v2M12 18v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M2 12h2M19 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>` :
                `<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>`;
        }

        si();
    </script>
@endpush