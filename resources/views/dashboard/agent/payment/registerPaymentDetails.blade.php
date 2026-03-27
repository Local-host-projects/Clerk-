{{-- <!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Make a Payment</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
  <style>
    [data-theme="dark"] {
      --bg:         #080808;
      --bg-off:     #0F0F0F;
      --bg-card:    #111111;
      --bg-input:   #0C0C0C;
      --border:     #1C1C1C;
      --border-mid: #282828;
      --text:       #EEECEA;
      --text-sub:   #484844;
      --accent:     #00E676;
      --accent-h:   #00FF88;
      --btn-fg:     #080808;
      --danger:     #FF4D4D;
      --grain:      0.028;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Syne', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    body::after {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
      opacity: var(--grain);
      pointer-events: none;
      z-index: 9999;
    }

    /* ── TOPBAR ── */
    .topbar {
      height: 56px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      background: var(--bg);
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .wordmark { font-weight: 800; font-size: 16px; letter-spacing: .14em; text-decoration: none; color: var(--text); }
    .wordmark span { color: var(--accent); }
    .topbar-tag {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-sub);
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border: 1px solid var(--border);
      padding: 5px 10px;
    }

    /* ── PAGE ── */
    .page {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 24px;
    }

    .payment-wrapper {
      width: 100%;
      max-width: 460px;
      animation: slideUp 0.4s ease-out both;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── CARD SECTIONS ── */
    .card-header {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-bottom: none;
      padding: 28px 32px 24px;
      position: relative;
      overflow: hidden;
    }
    .card-header::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 2px;
      background: var(--accent);
    }
    .card-header-label {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      color: var(--text-sub);
      text-transform: uppercase;
      letter-spacing: 0.15em;
      margin-bottom: 10px;
    }
    .card-header-title { font-size: 22px; font-weight: 800; line-height: 1.2; }
    .card-header-title span { color: var(--accent); }

    .card-body {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-top: 1px solid var(--border-mid);
      padding: 32px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .card-footer {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-top: none;
      padding: 14px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* ── MERCHANT INFO ── */
    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid var(--border);
    }
    .info-row:last-of-type { border-bottom: none; }
    .info-label {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      color: var(--text-sub);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }
    .info-value { font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text); }
    .info-value.accent { color: var(--accent); }

    .divider { height: 1px; background: var(--border); margin: 4px 0; }

    /* ── FORM ── */
    .form-group { display: flex; flex-direction: column; gap: 8px; }
    .form-group label {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-sub);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"] {
      background: var(--bg-input);
      border: 1px solid var(--border);
      padding: 14px 16px;
      color: var(--text);
      font-family: 'Space Mono', monospace;
      font-size: 13px;
      outline: none;
      width: 100%;
      transition: border-color 0.2s;
      -moz-appearance: textfield;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button { -webkit-appearance: none; }
    input:focus { border-color: var(--accent); }
    input.error { border-color: var(--danger); }

    .amount-wrapper { position: relative; }
    .amount-prefix {
      position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
      font-family: 'Space Mono', monospace; font-size: 13px;
      color: var(--text-sub); pointer-events: none;
    }
    .amount-wrapper input { padding-left: 36px; }

    .error-msg {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--danger);
      display: none;
    }
    .error-msg.visible { display: block; }

    /* ── BUTTON ── */
    .btn-pay {
      background: var(--accent);
      color: var(--btn-fg);
      border: none;
      width: 100%;
      padding: 16px;
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: background 0.2s, transform 0.1s;
      margin-top: 4px;
    }
    .btn-pay:hover { background: var(--accent-h); }
    .btn-pay:active { transform: scale(0.99); }
    .btn-pay:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }
    .btn-pay svg { width: 14px; height: 14px; stroke: var(--btn-fg); fill: none; stroke-width: 2.5; }

    /* ── FOOTER BADGES ── */
    .secured-badge {
      display: flex; align-items: center; gap: 8px;
      font-family: 'Space Mono', monospace; font-size: 9px;
      color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.1em;
    }
    .secured-badge svg { width: 12px; height: 12px; stroke: var(--accent); fill: none; stroke-width: 2; flex-shrink: 0; }
    .powered-by { font-family: 'Space Mono', monospace; font-size: 9px; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.08em; }
    .powered-by strong { color: var(--text); font-weight: 700; }
  </style>
</head>
<body>

<header class="topbar">
  <a href="#" class="wordmark">CLR<span>K</span></a>
  <div class="topbar-tag">Payment Portal</div>
</header>

<main class="page">
  <div class="payment-wrapper">

    <div class="card-header">
      <p class="card-header-label">Secure Transaction</p>
      <h1 class="card-header-title">Make a <span>Payment</span></h1>
    </div>

    <div class="card-body">

      <div>
        <div class="info-row">
          <span class="info-label">Merchant</span>
          <span class="info-value accent">MX276068</span>
        </div>
        <div class="info-row">
          <span class="info-label">Pay Item</span>
          <span class="info-value">Default_Payable_MX276068</span>
        </div>
      </div>

      <div class="divider"></div>

      <div class="form-group">
        <label for="cust-name">Full Name</label>
        <input type="text" id="cust-name" placeholder="e.g. Adebayo Okafor" autocomplete="name">
      </div>

      <div class="form-group">
        <label for="cust-email">Email Address</label>
        <input type="email" id="cust-email" placeholder="you@example.com" autocomplete="email">
        <span class="error-msg" id="email-err">A valid email address is required.</span>
      </div>

      <div class="form-group">
        <label for="amount">Amount (NGN)</label>
        <div class="amount-wrapper">
          <span class="amount-prefix">₦</span>
          <input type="number" id="amount" placeholder="0.00" min="1" step="0.01">
        </div>
        <span class="error-msg" id="amount-err">Please enter an amount greater than ₦0.</span>
      </div>

      <button class="btn-pay" id="pay-btn" onclick="initiatePayment()">
        <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        Proceed to Pay
      </button>

    </div>

    <div class="card-footer">
      <div class="secured-badge">
        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        256-bit SSL encrypted
      </div>
      <div class="powered-by">Powered by <strong>Interswitch</strong></div>
    </div>

  </div>
</main>

<!-- LIVE script — swap to qa.interswitchng.com for test mode -->
<script src="https://newwebpay.qa.interswitchng.com/inline-checkout.js"></script>

<script>
  const CONFIG = {
    merchant_code: "MX007",
    pay_item_id: "101007",
    txn_ref: "sample_txn_ref_123",
    pay_item_name:     'Clerk Payment',
    tokenise_card: "true",
    site_redirect_url: 'https://yoursite.com/payment/callback', // ← update this
    currency:          566,
    mode:              '', // ← change to 'TEST' + use qa script above for testing
  };

  function generateTxnRef() {
    return 'CLERK_' + Date.now() + '_' + Math.random().toString(36).substr(2, 6).toUpperCase();
  }

  function validate() {
    let valid = true;

    const emailInput = document.getElementById('cust-email');
    const emailOk    = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim());
    emailInput.classList.toggle('error', !emailOk);
    document.getElementById('email-err').classList.toggle('visible', !emailOk);
    if (!emailOk) valid = false;

    const amountInput = document.getElementById('amount');
    const amountOk    = parseFloat(amountInput.value) > 0;
    amountInput.classList.toggle('error', !amountOk);
    document.getElementById('amount-err').classList.toggle('visible', !amountOk);
    if (!amountOk) valid = false;

    return valid;
  }

  function setBtn(loading) {
    const btn = document.getElementById('pay-btn');
    btn.disabled = loading;
    btn.innerHTML = loading
      ? `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#080808;fill:none;stroke-width:2.5"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg> Processing...`
      : `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#080808;fill:none;stroke-width:2.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg> Proceed to Pay`;
  }

  function paymentCallback(response) {
    console.log('Interswitch response:', response);
    setBtn(false);
    // ⚠️ Use response.txnref to requery server-side before giving value
  }

  function initiatePayment() {
    if (!validate()) return;

    setBtn(true);

    window.webpayCheckout({
      ...CONFIG,
      txn_ref:   generateTxnRef(),
      amount:    Math.round(parseFloat(document.getElementById('amount').value) * 100),
      cust_name: document.getElementById('cust-name').value.trim(),
      cust_email: document.getElementById('cust-email').value.trim(),
      onComplete: paymentCallback,
    });

    // Re-enable if user closes the modal without completing payment
    setTimeout(() => setBtn(false), 5000);
  }
</script>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Make a Payment</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
  <style>
    /* ── THEME & BASE STYLES ── */
    [data-theme="dark"] {
      --bg: #080808;
      --bg-card: #111111;
      --bg-input: #0C0C0C;
      --border: #1C1C1C;
      --border-mid: #282828;
      --text: #EEECEA;
      --text-sub: #484844;
      --accent: #00E676;
      --accent-h: #00FF88;
      --btn-fg: #080808;
      --danger: #FF4D4D;
      --grain: 0.028;
    }
    *, *::before, *::after { box-sizing: border-box; margin:0; padding:0; }
    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Syne', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    body::after {
      content:'';
      position: fixed; inset:0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
      opacity: var(--grain); pointer-events:none; z-index:9999;
    }
    /* ── TOPBAR ── */
    .topbar {
      height: 56px; border-bottom:1px solid var(--border);
      display:flex; align-items:center; justify-content:space-between;
      padding:0 24px; background:var(--bg); position:sticky; top:0; z-index:50;
    }
    .wordmark { font-weight:800; font-size:16px; letter-spacing:.14em; text-decoration:none; color:var(--text); }
    .wordmark span { color:var(--accent); }
    .topbar-tag { font-family:'Space Mono', monospace; font-size:10px; color:var(--text-sub); text-transform:uppercase; letter-spacing:.1em; border:1px solid var(--border); padding:5px 10px; }

    /* ── PAGE ── */
    .page { flex:1; display:flex; align-items:center; justify-content:center; padding:48px 24px; }
    .payment-wrapper { width:100%; max-width:460px; animation: slideUp 0.4s ease-out both; }
    @keyframes slideUp { from { opacity:0; transform:translateY(16px);} to{opacity:1; transform:translateY(0);} }

    /* ── CARD ── */
    .card-header, .card-body, .card-footer { background:var(--bg-card); border:1px solid var(--border); }
    .card-header { border-bottom:none; padding:28px 32px 24px; position:relative; overflow:hidden; }
    .card-header::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--accent); }
    .card-header-label { font-family:'Space Mono', monospace; font-size:9px; color:var(--text-sub); text-transform:uppercase; letter-spacing:.15em; margin-bottom:10px; }
    .card-header-title { font-size:22px; font-weight:800; line-height:1.2; }
    .card-header-title span { color:var(--accent); }
    .card-body { border-top:1px solid var(--border-mid); padding:32px; display:flex; flex-direction:column; gap:20px; }
    .card-footer { border-top:none; padding:14px 32px; display:flex; align-items:center; justify-content:space-between; }

    /* ── MERCHANT INFO ── */
    .info-row { display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid var(--border); }
    .info-row:last-of-type{border-bottom:none;}
    .info-label { font-family:'Space Mono', monospace; font-size:9px; color:var(--text-sub); text-transform:uppercase; letter-spacing:.1em; }
    .info-value { font-family:'Space Mono', monospace; font-size:11px; color:var(--text); }
    .info-value.accent { color:var(--accent); }
    .divider { height:1px; background:var(--border); margin:4px 0; }

    /* ── FORM ── */
    .form-group { display:flex; flex-direction:column; gap:8px; }
    label { font-family:'Space Mono', monospace; font-size:10px; color:var(--text-sub); text-transform:uppercase; letter-spacing:.1em; }
    input[type=text], input[type=email], input[type=number] { background:var(--bg-input); border:1px solid var(--border); padding:14px 16px; color:var(--text); font-family:'Space Mono', monospace; font-size:13px; outline:none; width:100%; transition:border-color .2s; -moz-appearance:textfield; }
    input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance:none; }
    input:focus { border-color: var(--accent); }
    input.error { border-color: var(--danger); }
    .amount-wrapper { position:relative; }
    .amount-prefix { position:absolute; left:16px; top:50%; transform:translateY(-50%); font-family:'Space Mono', monospace; font-size:13px; color:var(--text-sub); pointer-events:none; }
    .amount-wrapper input { padding-left:36px; }
    .error-msg { font-family:'Space Mono', monospace; font-size:10px; color:var(--danger); display:none; }
    .error-msg.visible { display:block; }

    /* ── BUTTON ── */
    .btn-pay { background:var(--accent); color:var(--btn-fg); border:none; width:100%; padding:16px; font-family:'Syne',sans-serif; font-weight:800; font-size:13px; text-transform:uppercase; letter-spacing:.08em; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:10px; transition:background .2s, transform .1s; margin-top:4px; }
    .btn-pay:hover { background:var(--accent-h); }
    .btn-pay:active { transform:scale(0.99); }
    .btn-pay:disabled { opacity:.4; cursor:not-allowed; transform:none; }
    .btn-pay svg { width:14px; height:14px; stroke:var(--btn-fg); fill:none; stroke-width:2.5; }

    /* ── FOOTER BADGES ── */
    .secured-badge { display:flex; align-items:center; gap:8px; font-family:'Space Mono', monospace; font-size:9px; color:var(--text-sub); text-transform:uppercase; letter-spacing:.1em; }
    .secured-badge svg { width:12px; height:12px; stroke:var(--accent); fill:none; stroke-width:2; flex-shrink:0; }
    .powered-by { font-family:'Space Mono', monospace; font-size:9px; color:var(--text-sub); text-transform:uppercase; letter-spacing:.08em; }
    .powered-by strong { color:var(--text); font-weight:700; }
  </style>
</head>
<body>

<header class="topbar">
  <a href="#" class="wordmark">CLR<span>K</span></a>
  <div class="topbar-tag">Payment Portal</div>
</header>

<main class="page">
  <div class="payment-wrapper">

    <div class="card-header">
      <p class="card-header-label">Secure Transaction</p>
      <h1 class="card-header-title">Make a <span>Payment</span></h1>
    </div>

    <div class="card-body">

      <div>
        <div class="info-row">
          <span class="info-label">Merchant</span>
          <span class="info-value accent">MX007</span>
        </div>
        <div class="info-row">
          <span class="info-label">Pay Item</span>
          <span class="info-value">101007</span>
        </div>
      </div>

      <div class="divider"></div>

      <div class="form-group">
        <label for="cust-name">Full Name</label>
        <input type="text" id="cust-name" placeholder="e.g. Adebayo Okafor" autocomplete="name">
      </div>

      <div class="form-group">
        <label for="cust-email">Email Address</label>
        <input type="email" id="cust-email" placeholder="you@example.com" autocomplete="email">
        <span class="error-msg" id="email-err">A valid email address is required.</span>
      </div>

      <div class="form-group">
        <label for="amount">Amount (NGN)</label>
        <div class="amount-wrapper">
          <span class="amount-prefix">₦</span>
          <input type="number" id="amount" placeholder="0.00" min="1" step="0.01">
        </div>
        <span class="error-msg" id="amount-err">Please enter an amount greater than ₦0.</span>
      </div>

      <button class="btn-pay" id="pay-btn" onclick="initiatePayment()">
        <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        Proceed to Pay
      </button>

    </div>

    <div class="card-footer">
      <div class="secured-badge">
        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        256-bit SSL encrypted
      </div>
      <div class="powered-by">Powered by <strong>Interswitch</strong></div>
    </div>

  </div>
</main>

<!-- Inline Checkout Script for TEST Mode -->
<script src="https://newwebpay.qa.interswitchng.com/inline-checkout.js"></script>

<script>
  const CONFIG = {
    merchant_code: "MX007",
    pay_item_id: "101007",
    pay_item_name: "Clerk Payment",
    site_redirect_url: "https://yoursite.com/payment/callback", // replace with your test callback
    tokenise_card: "true",
    currency: 566, // NGN
    mode: 'TEST',
  };

  function generateTxnRef() {
    return 'CLERK_' + Date.now() + '_' + Math.random().toString(36).substring(2,8).toUpperCase();
  }

  function validate() {
    let valid = true;

    const emailInput = document.getElementById('cust-email');
    const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim());
    emailInput.classList.toggle('error', !emailOk);
    document.getElementById('email-err').classList.toggle('visible', !emailOk);
    if (!emailOk) valid = false;

    const amountInput = document.getElementById('amount');
    const amountOk = parseFloat(amountInput.value) > 0;
    amountInput.classList.toggle('error', !amountOk);
    document.getElementById('amount-err').classList.toggle('visible', !amountOk);
    if (!amountOk) valid = false;

    return valid;
  }

  function setBtn(loading) {
    const btn = document.getElementById('pay-btn');
    btn.disabled = loading;
    btn.innerHTML = loading
      ? `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#080808;fill:none;stroke-width:2.5"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg> Processing...`
      : `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#080808;fill:none;stroke-width:2.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg> Proceed to Pay`;
  }

  function paymentCallback(response) {
    console.log('Interswitch response:', response);
    setBtn(false);
    alert(`Transaction Status: ${response.ResponseDescription || 'Check console for details'}`);
  }

  function initiatePayment() {
    if (!validate()) return;

    setBtn(true);

    window.webpayCheckout({
      ...CONFIG,
      txn_ref: generateTxnRef(),
      amount: Math.round(parseFloat(document.getElementById('amount').value) * 100),
      cust_name: document.getElementById('cust-name').value.trim(),
      cust_email: document.getElementById('cust-email').value.trim(),
      onComplete: paymentCallback
    });

    // Safety fallback if modal is closed
    setTimeout(() => setBtn(false), 5000);
  }
</script>

</body>
</html>
