<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Complete Your Profile</title>
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
  --bg-input:   #0C0C0C;
  --border:     #1C1C1C;
  --border-mid: #282828;
  --border-hi:  #363636;
  --text:       #EEECEA;
  --text-sub:   #484844;
  --accent:     #00E676;
  --accent-h:   #00FF88;
  --btn-fg:     #080808;
  --grain:      0.028;
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{
  background:var(--bg); color:var(--text);
  font-family:'Syne', sans-serif;
  min-height:100vh; display:flex; flex-direction:column;
  align-items:center; justify-content:center; padding:40px 20px;
}

body::after{
  content:''; position:fixed; inset:0;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity:var(--grain); pointer-events:none; z-index:9999;
}

/* ═══════════════════════════════════════════
   LAYOUT
═══════════════════════════════════════════ */
.onboarding-container {
  width: 100%; max-width: 500px;
  display: flex; flex-direction: column; gap: 32px;
  z-index: 10;
}

.header { text-align: center; }
.wordmark { font-weight: 800; font-size: 14px; letter-spacing: .2em; color: var(--text-sub); margin-bottom: 12px; display: block; }
.title { font-size: 32px; font-weight: 800; line-height: 1.1; }

/* Role Toggle */
.role-toggle {
  display: grid; grid-template-columns: 1fr 1fr;
  background: var(--bg-off); border: 1px solid var(--border);
  padding: 4px; position: relative;
}
.role-btn {
  background: none; border: none; padding: 12px;
  font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700;
  color: var(--text-sub); cursor: pointer; text-transform: uppercase;
  z-index: 2; transition: color 0.3s;
}
.role-btn.active { color: var(--btn-fg); }
.toggle-slider {
  position: absolute; top: 4px; bottom: 4px; left: 4px;
  width: calc(50% - 4px); background: var(--accent);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 1;
}
.role-toggle[data-active="agent"] .toggle-slider { transform: translateX(100%); }

/* Forms */
.form-card {
  background: var(--bg-card); border: 1px solid var(--border-hi);
  padding: 40px; display: flex; flex-direction: column; gap: 24px;
}
.hidden { display: none; }

.input-group { display: flex; flex-direction: column; gap: 8px; }
.input-group label { 
  font-family: 'Space Mono', monospace; font-size: 9px; 
  color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.1em;
}
input, select {
  background: var(--bg-input); border: 1px solid var(--border); padding: 14px;
  color: var(--text); font-family: 'Space Mono', monospace; font-size: 13px; outline: none; width: 100%;
}
input:focus { border-color: var(--accent); }

.btn-submit {
  background: var(--accent); color: var(--btn-fg); border: none; padding: 16px;
  font-family: 'Syne', sans-serif; font-weight: 800; font-size: 14px; 
  text-transform: uppercase; cursor: pointer; margin-top: 8px;
}
.btn-submit:hover { background: var(--accent-h); }

.help-text {
  font-family: 'Space Mono', monospace; font-size: 10px; color: var(--text-sub);
  text-align: center; line-height: 1.5;
}

  </style>
</head>
<body>

<div class="onboarding-container">
  <div class="header">
    <span class="wordmark">CLERK // ACCESS</span>
    <h1 class="title">Complete your<br>enrollment.</h1>
  </div>

  <!-- Switcher -->
  <div class="role-toggle" id="role-toggle" data-active="merchant">
    <div class="toggle-slider"></div>
    <button class="role-btn active" id="btn-merchant" onclick="setRole('merchant')">Merchant</button>
    <button class="role-btn" id="btn-agent" onclick="setRole('agent')">Agent</button>
  </div>

  <!-- Merchant Form (Maps to merchant_profiles table) -->
  <form id="form-merchant" class="form-card" method='post'>
    <div class="input-group">
      <label>Business Name</label>
      <input type="text" name="business_name" placeholder="Acme Corp" required>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="input-group">
            <label>Business Phone</label>
            <input type="tel" name="business_phone" placeholder="+234...">
        </div>
        <div class="input-group">
            <label>Business Email</label>
            <input type="email" name="business_email" placeholder="hi@acme.com">
        </div>
    </div>

    <div class="input-group">
        <label>Business Address</label>
        <input type="text" name="business_address" placeholder="Physical location">
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 16px;">
        <div class="input-group">
            <label>Settlement Account Number</label>
            <input type="text" name="business_account_number" placeholder="0000000000" required>
        </div>
        <div class="input-group">
            <label>Bank</label>
            <input type="text" name="bank" placeholder="Access Bank" required>
        </div>
    </div>

    <button type="submit" class="btn-submit">Initialize Merchant Account</button>
  </form>

  <!-- Agent Form (Maps to agent_profiles table) -->
  <form id="form-agent" class="form-card hidden">
    <div class="input-group">
      <label>Full Legal Name</label>
      <input type="text" name="full_name" placeholder="John Doe" required>
    </div>

    <div class="input-group">
      <label>Phone Number</label>
      <input type="tel" name="phone" placeholder="+234..." required>
    </div>

    <div class="input-group">
        <label>Residential Address</label>
        <input type="text" name="address" placeholder="Lagos, Nigeria">
    </div>

    <div class="input-group">
        <label>Primary Bank Account</label>
        <input type="text" name="connected_bank_accounts" placeholder="Bank Name — Account Number">
    </div>

    <button type="submit" class="btn-submit">Activate Agent Terminal</button>
  </form>

  <p class="help-text">
    YOU ARE BEING REDIRECTED BECAUSE YOUR PROFILE STATUS IS <span style="color:var(--accent)">INCOMPLETE</span>.<br>
    CHOOSE A PATH TO CONTINUE TO YOUR DASHBOARD.
  </p>
</div>

<script>
  /**
   * INITIALIZATION
   * Determine starting view via 'property' (simulated via URL param or local logic)
   */
  window.onload = () => {
    // Example property: change to 'agent' to show agent form first
    const preferredRole = new URLSearchParams(window.location.search).get('role') || 'merchant';
    setRole(preferredRole);
  };

  function setRole(role) {
    const toggle = document.getElementById('role-toggle');
    const merchantForm = document.getElementById('form-merchant');
    const agentForm = document.getElementById('form-agent');
    const btnM = document.getElementById('btn-merchant');
    const btnA = document.getElementById('btn-agent');

    toggle.setAttribute('data-active', role);

    if (role === 'merchant') {
      merchantForm.classList.remove('hidden');
      agentForm.classList.add('hidden');
      btnM.classList.add('active');
      btnA.classList.remove('active');
    } else {
      merchantForm.classList.add('hidden');
      agentForm.classList.remove('hidden');
      btnM.classList.remove('active');
      btnA.classList.add('active');
    }
  }

  // Handle Form Submissions (prevent reload for demo)
  document.querySelectorAll('form').forEach(form => {
    form.onsubmit = (e) => {
      e.preventDefault();
      const formData = new FormData(form);
      const data = Object.fromEntries(formData.entries());
      
      console.log(`Submitting ${form.id} data:`, data);
      
      const btn = form.querySelector('.btn-submit');
      btn.innerText = "Processing...";
      btn.style.opacity = "0.5";
      
      setTimeout(() => {
        alert(`${data.business_name || data.full_name} registered successfully. Status: COMPLETE.`);
        // In reality: window.location.href = '/dashboard';
      }, 1500);
    };
  });
</script>

</body>
</html>