<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Order Confirmed</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #0A0A0A; --bg-off: #111; --border: #222; --text: #F5F5F0; 
      --text-muted: #555; --accent: #00E676; --accent-hover: #00ff85; --btn-text: #0A0A0A;
    }
    [data-theme="light"] {
      --bg: #F4F3EF; --bg-off: #ECEAE5; --border: #D0CEC8; --text: #111; 
      --text-muted: #888; --accent: #007A38; --accent-hover: #009444; --btn-text: #FFF;
    }

    body { 
      background: var(--bg); color: var(--text); font-family: 'Syne', sans-serif; 
      margin: 0; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .mono { font-family: 'Space Mono', monospace; }

    /* Layout Containers */
    .success-container { max-width: 500px; width: 90%; text-align: center; }
    
    /* Order ID Block (Center of Attention) */
    .id-block {
        background: var(--bg-off);
        border: 1px solid var(--accent);
        padding: 40px 20px;
        margin: 24px 0;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }
    .id-block:hover { border-color: var(--accent-hover); background: var(--bg); }
    .id-label { font-family: 'Space Mono'; font-size: 10px; color: var(--accent); letter-spacing: 0.2em; margin-bottom: 12px; display: block; }
    .id-value { font-size: 32px; font-weight: 800; letter-spacing: -0.02em; display: block; }

    /* Info Components */
    .c-block { border: 1px solid var(--border); background: var(--bg); margin-bottom: 24px; text-align: left; }
    .c-row { display: flex; justify-content: space-between; padding: 14px 18px; border-bottom: 1px solid var(--border); font-family: 'Space Mono'; font-size: 11px; }
    .c-row:last-child { border-bottom: none; }
    .c-label { color: var(--text-muted); text-transform: uppercase; }

    .status-badge {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 6px 12px; background: var(--bg-off); border: 1px solid var(--border);
      font-family: 'Space Mono'; font-size: 10px; color: var(--accent);
      margin-top: 10px;
    }

    .btn-action { 
      width: 100%; background: var(--text); color: var(--bg); border: none; 
      padding: 18px; font-weight: 800; font-family: 'Syne'; text-transform: uppercase; 
      cursor: pointer; transition: opacity 0.2s;
    }
    .btn-action:hover { opacity: 0.9; }

    /* Tooltip logic */
    .copy-hint { 
        position: absolute; bottom: 10px; right: 10px; font-family: 'Space Mono'; 
        font-size: 8px; color: var(--text-muted); opacity: 0.6;
    }
  </style>
</head>

<body>

  <div class="success-container">
    <p class="mono" style="font-size: 10px; color: var(--accent); letter-spacing: 0.3em;">TRANSACTION_SUCCESSFUL</p>
    <h1 style="font-size: 48px; margin: 10px 0 0 0; line-height: 0.9;">Order Placed.</h1>

    <div class="id-block" onclick="copyOrderID()" title="Click to copy">
        <span class="id-label">UNIQUE ORDER REFERENCE</span>
        <span class="id-value" id="order-id">{{ $order->order_id  }}</span>
        <span class="copy-hint" id="copy-text">[ CLICK TO COPY ID ]</span>
    </div>

    <div class="status-badge">
        <span style="width: 6px; height: 6px; background: var(--accent); border-radius: 50%;"></span>
        STATUS: {{ucwords($order->status)}}
    </div>

    <div style="margin: 40px 0 24px 0;">
        <p class="mono" style="font-size: 10px; color: var(--text-muted); text-align: left; margin-bottom: 8px;">BRIEF SUMMARY</p>
        <div class="c-block">
            <div class="c-row">
                <span class="c-label">Product</span>
                <span>{{ $product->name }}</span>
            </div>
            <div class="c-row">
                <span class="c-label">Quantity</span>
                <span>{{ $order->quantity }} Units</span>
            </div>
            <div class="c-row">
                <span class="c-label">Total Paid</span>
                <span style="color: var(--accent); font-weight: 700;">₦{{ number_format($order->total_price) }}</span>
            </div>
        </div>
    </div>

    <a href="{{ url('/') }}" style="text-decoration: none;">
        <button class="btn-action">Return to Storefront →</button>
    </a>
    
    <p class="mono" style="font-size: 9px; color: var(--text-muted); margin-top: 24px; line-height: 1.6;">
        A confirmation email has been dispatched to your registered address. <br>
        Powered by CLERK Protocol.
    </p>
  </div>

  <script>
    function copyOrderID() {
      const orderIdText = document.getElementById('order-id').innerText;
      const hint = document.getElementById('copy-text');
      
      navigator.clipboard.writeText(orderIdText).then(() => {
        const originalHint = hint.innerText;
        hint.innerText = "[ COPIED TO CLIPBOARD ]";
        hint.style.color = "var(--accent)";
        
        setTimeout(() => {
          hint.innerText = originalHint;
          hint.style.color = "var(--text-muted)";
        }, 2000);
      });
    }

    // Auto-toggle theme based on parent context if needed
    // (Existing theme logic can be added here)
  </script>

</body>
</html>