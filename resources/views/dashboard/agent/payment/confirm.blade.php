<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order &mdash; Clerk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;500;600&display=swap');

        :root {
            --apple-blue:   #0071e3;
            --apple-green:  #34c759;
            --apple-amber:  #ff9f0a;
            --glass-bg:     rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            background-color: #000000;
            color: #ffffff;
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Animated checkmark ── */
        .check-icon {
            width: 80px; height: 80px;
            position: relative;
            border-radius: 50%;
            border: 3px solid var(--apple-green);
            flex-shrink: 0;
        }

        .check-icon::before, .check-icon::after {
            content: ''; height: 80px;
            position: absolute;
            background: #000;
            transform: rotate(-45deg);
        }

        .check-icon::before {
            top: 3px; left: -3px; width: 30px;
            transform-origin: 100% 50%;
            border-radius: 100px 0 0 100px;
        }

        .check-icon::after {
            top: 0; left: 30px; width: 52px;
            transform-origin: 0 50%;
            border-radius: 0 100px 100px 0;
        }

        .icon-line {
            height: 3px;
            background-color: var(--apple-green);
            display: block; border-radius: 2px;
            position: absolute; z-index: 10;
        }

        .icon-line.line-tip {
            top: 39px; left: 25px; width: 40px;
            transform: rotate(-45deg);
            animation: icon-line-tip 0.75s;
        }

        .icon-line.line-long {
            top: 47px; left: 14px; width: 23px;
            transform: rotate(45deg);
            animation: icon-line-long 0.75s;
        }

        .icon-circle {
            top: -3px; left: -3px; z-index: 10;
            width: 80px; height: 80px;
            border-radius: 50%; position: absolute;
            border: 3px solid rgba(52,199,89,0.2);
        }

        .icon-fix {
            top: 8px; left: 24px;
            width: 3px; height: 64px;
            position: absolute; z-index: 1;
            transform: rotate(-45deg);
            background-color: #000;
        }

        @keyframes icon-line-tip {
            0%   { width: 0;  left: 6px;  top: 20px; }
            54%  { width: 0;  left: 6px;  top: 20px; }
            70%  { width: 34px; left: -8px; top: 30px; }
            84%  { width: 23px; left: 30px; top: 40px; }
            100% { width: 40px; left: 25px; top: 39px; }
        }

        @keyframes icon-line-long {
            0%   { width: 0; left: 38px; top: 50px; }
            65%  { width: 0; left: 38px; top: 50px; }
            100% { width: 23px; left: 14px; top: 47px; }
        }

        /* ── Main card ── */
        .confirm-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 40px 36px;
            max-width: 500px;
            width: 100%;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.2s;
        }

        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Receipt ── */
        .receipt-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 10px;
            font-size: 13.5px;
        }

        .receipt-label { color: rgba(255,255,255,0.45); }
        .receipt-value { color: #fff; font-weight: 500; }

        .divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.07);
            margin: 14px 0;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: var(--apple-blue);
            color: #fff;
            font-weight: 500;
            font-family: inherit;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .btn-primary:hover {
            transform: scale(1.015);
            filter: brightness(1.12);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.7);
            font-family: inherit;
            font-size: 14px;
            font-weight: 400;
            padding: 13px 32px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.1);
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background 0.2s ease;
        }

        .btn-secondary:hover { background: rgba(255,255,255,0.1); }

        /* ── Status pill ── */
        .status-pill {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 500;
            letter-spacing: .04em;
            padding: 3px 10px;
            border-radius: 999px;
        }

        .status-pending {
            background: rgba(255,159,10,0.15);
            color: var(--apple-amber);
            border: 1px solid rgba(255,159,10,0.25);
        }

        .status-paid {
            background: rgba(52,199,89,0.15);
            color: var(--apple-green);
            border: 1px solid rgba(52,199,89,0.25);
        }

        .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        /* ── Secret code box ── */
        .secret-box {
            font-family: 'SF Mono', 'Fira Code', monospace;
            font-size: 15px;
            letter-spacing: .22em;
            color: rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 12px 16px;
            text-align: center;
            margin-bottom: 24px;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            user-select: none;
        }

        .secret-box:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.18);
        }

        .secret-box-label {
            display: block;
            font-size: 10px;
            letter-spacing: .08em;
            color: rgba(255,255,255,0.28);
            margin-bottom: 5px;
            font-family: 'SF Pro Display', sans-serif;
            text-transform: uppercase;
        }

        /* ── Product chip ── */
        .product-chip {
            display: flex; align-items: center; gap: 12px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 20px;
        }

        .product-chip img {
            width: 40px; height: 40px;
            object-fit: cover;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
        }

        .type-badge {
            font-size: 10px; font-weight: 500;
            padding: 2px 8px; border-radius: 6px;
            background: rgba(0,113,227,0.15);
            color: #60a5fa;
            border: 1px solid rgba(0,113,227,0.25);
            letter-spacing: .05em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── Logo ── */
        .clerk-logo {
            font-size: 11px; font-weight: 600;
            letter-spacing: .2em;
            color: rgba(255,255,255,0.22);
            text-transform: uppercase;
        }

        .section-label {
            font-size: 10px;
            color: rgba(255,255,255,0.28);
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="confirm-card">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-7">
            <p class="clerk-logo">Clerk</p>
            <p class="text-xs" style="color:rgba(255,255,255,0.28)">Agent Portal</p>
        </div>

        {{-- Title + checkmark --}}
        <div class="flex items-center gap-4 mb-7">
            <div class="check-icon">
                <span class="icon-line line-long"></span>
                <span class="icon-line line-tip"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
            <div>
                <h1 class="text-2xl font-semibold tracking-tight leading-snug">Order Ready</h1>
                <p class="text-sm mt-1" style="color:rgba(255,255,255,0.42)">
                    Collect cash from customer, then confirm below.
                </p>
            </div>
        </div>

        {{-- Product --}}
        <div class="product-chip">
            <img
                src="{{ asset('storage/' . $product->image_url) }}"
                alt="{{ $product->name }}"
                onerror="this.style.opacity=0"
            >
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate" style="max-width:220px">{{ $product->name }}</p>
                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.38)">
                    {{ $order->quantity }} &times; ₦{{ number_format($product->price, 2) }}
                </p>
            </div>
            <span class="type-badge">{{ $product->type }}</span>
        </div>

        {{-- Secret (agent shares this to verify with customer) --}}
        <div class="secret-box" id="secretBox" onclick="copySecret()" title="Tap to copy">
            <span class="secret-box-label">Order Secret &mdash; verify with customer</span>
            {{ $order->secret }}
        </div>

        {{-- Receipt --}}
        <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);border-radius:18px;padding:20px 22px;margin-bottom:24px">

            <p class="section-label">Order Details</p>

            <div class="receipt-row">
                <span class="receipt-label">Order ID</span>
                <span class="receipt-value" style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;letter-spacing:.08em">
                    #{{ $order->order_id }}
                </span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Date</span>
                <span class="receipt-value">
                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y · h:i A') }}
                </span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Payment</span>
                <span class="receipt-value" style="text-transform:capitalize">
                    {{ str_replace('_', ' ', $order->payment_method) }}
                </span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Status</span>
                <span>
                    @if($order->payment_status === 'paid')
                        <span class="status-pill status-paid">
                            <span class="dot"></span> Paid
                        </span>
                    @else
                        <span class="status-pill status-pending">
                            <span class="dot"></span> Awaiting Payment
                        </span>
                    @endif
                </span>
            </div>

            <hr class="divider">

            <p class="section-label">Customer</p>

            <div class="receipt-row">
                <span class="receipt-label">Name</span>
                <span class="receipt-value">{{ $order->customer_name }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Phone</span>
                <span class="receipt-value">{{ $order->customer_phone }}</span>
            </div>

            @if($order->customer_email)
            <div class="receipt-row">
                <span class="receipt-label">Email</span>
                <span class="receipt-value" style="font-size:12px">{{ $order->customer_email }}</span>
            </div>
            @endif

            <div class="receipt-row" style="align-items:flex-start">
                <span class="receipt-label">Address</span>
                <span class="receipt-value text-right" style="max-width:210px;line-height:1.5">
                    {{ $order->address }},<br>
                    {{ $order->city }}@if($order->postal_code) &nbsp;{{ $order->postal_code }}@endif
                </span>
            </div>

            <hr class="divider">

            {{-- Totals --}}
            @php
                $subtotal   = $product->price * $order->quantity;
                $serviceFee = $subtotal * 0.015;
            @endphp

            <div class="receipt-row">
                <span class="receipt-label">Subtotal</span>
                <span class="receipt-value">₦{{ number_format($subtotal, 2) }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Service Fee (1.5%)</span>
                <span class="receipt-value">₦{{ number_format($serviceFee, 2) }}</span>
            </div>

            <div class="receipt-row" style="margin-top:8px">
                <span class="text-base font-semibold">Total to Collect</span>
                <span class="text-base font-semibold">₦{{ number_format($order->total_price, 2) }}</span>
            </div>

        </div>

        {{-- CTA --}}
        <form method="POST" action="">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn-primary">
                Confirm Cash Received
            </button>
        </form>

        <button class="btn-secondary" onclick="window.history.back()">
            Go Back
        </button>

    </div>

    <script>
        function copySecret() {
            const box   = document.getElementById('secretBox');
            const lines = box.innerText.trim().split('\n');
            const secret = lines[lines.length - 1].trim();

            navigator.clipboard.writeText(secret).then(() => {
                const label = box.querySelector('.secret-box-label');
                const orig  = label.textContent;
                label.textContent = 'Copied to clipboard!';
                setTimeout(() => label.textContent = orig, 1800);
            });
        }
    </script>

</body>
</html>