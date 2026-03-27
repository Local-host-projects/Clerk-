{{-- <!DOCTYPE html>
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
  <div class="role-toggle" id="role-toggle" data-active="{{$role}}">
    <div class="toggle-slider"></div>
    <button class="role-btn active" id="btn-merchant" onclick="setRole('merchant')">Merchant</button>
    <button class="role-btn" id="btn-agent" onclick="setRole('agent')">Agent</button>
  </div>


  <!-- Merchant Form (Maps to merchant_profiles table) -->
  <form id="form-merchant" class="form-card" method='post' action="{{route('merchant.profile.store')}}">
  @csrf
  @if (session()->has('error'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ session('error') }}
    </span>
  @endif
    <div class="input-group">
      <label>Business Name</label>
      @if ($errors->has('business_name'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_name') }}
    </span>
      @endif
      <input type="text" name="business_name" value="{{old('business_name')}}" placeholder="Acme Corp" required>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="input-group">
            <label>Business Phone</label>
            @if ($errors->has('business_phone'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_phone') }}
    </span>
      @endif
            <input type="tel" name="business_phone" value="{{old('business_phone')}}" placeholder="+234...">
        </div>
        <div class="input-group">
            <label>Business Email</label>
            @if ($errors->has('business_email'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_email') }}
    </span>
      @endif
            <input type="email" name="business_email" value="{{old('business_email')}}" placeholder="hi@acme.com">
        </div>
    </div>

    <div class="input-group">
        <label>Business Address</label>
        @if ($errors->has('business_address'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_address') }}
    </span>
      @endif
        <input type="text" name="business_address" value="{{old('business_address')}}" placeholder="Physical location">
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 16px;">
        <div class="input-group">
            <label>Settlement Account Number</label>
            @if ($errors->has('business_account_number'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_account_number') }}
    </span>
      @endif
            <input type="text" name="business_account_number" value="{{old('business_account_name')}}" placeholder="0000000000" required>
        </div>
        <div class="input-group">
            <label>Bank</label>
            @if ($errors->has('bank'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('bank') }}
    </span>
      @endif
            <input type="text" name="bank" value="{{old('bank')}}" placeholder="Access Bank" required>
        </div>
    </div>

    <button type="submit" class="btn-submit">Initialize Merchant Account</button>
  </form>

  <!-- Agent Form (Maps to agent_profiles table) -->
  <form id="form-agent" class="form-card hidden" method="post" action='{{route('agent.profile.store')}}'>
  @csrf
  @if (session()->has('error'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ session('error') }}
    </span>
@endif
    <div class="input-group">
      <label>Full Legal Name</label>
      @if ($errors->has('full_name'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('full_name') }}
    </span>
      @endif
      <input type="text" name="full_name" value="{{old('full_name')}}" placeholder="John Doe" required>
    </div>

    <div class="input-group">
      <label>Phone Number</label>
      @if ($errors->has('phone'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('phone') }}
    </span>
      @endif
      <input type="tel" name="phone" value="{{old('phone')}}" placeholder="+234..." required>
    </div>

    <div class="input-group">
        <label>Residential Address</label>
        @if ($errors->has('address'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('address') }}
    </span>
      @endif
        <input type="text" name="address" value="{{old('address')}}" placeholder="Lagos, Nigeria">
    </div>

    <div class="input-group">
        <label>Primary Bank Account</label>
        @if ($errors->has('connected_bank_accounts'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('connected_bank_accounts') }}
    </span>
      @endif
        <input type="text" name="connected_bank_accounts" value="{{old('connected_bank_accounts')}}" placeholder="Bank Name — Account Number">
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
  const preferredRole = document.getElementById('role-toggle').dataset.active;
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
  // document.querySelectorAll('form').forEach(form => {
  //   form.onsubmit = (e) => {
  //     e.preventDefault();
  //     const formData = new FormData(form);
  //     const data = Object.fromEntries(formData.entries());
      
  //     console.log(`Submitting ${form.id} data:`, data);
      
  //     const btn = form.querySelector('.btn-submit');
  //     btn.innerText = "Processing...";
  //     btn.style.opacity = "0.5";
      
  //     setTimeout(() => {
  //       alert(`${data.business_name || data.full_name} registered successfully. Status: COMPLETE.`);
  //       // In reality: window.location.href = '/dashboard';
  //     }, 1500);
  //   };
  // });
</script>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Complete Your Profile</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
  <style>
    /* ═════════ TOKENS ═════════ */
    [data-theme="dark"] {
      --bg: #080808;
      --bg-off: #0F0F0F;
      --bg-card: #111111;
      --bg-input: #0C0C0C;
      --border: #1C1C1C;
      --border-mid: #282828;
      --border-hi: #363636;
      --text: #EEECEA;
      --text-sub: #484844;
      --accent: #00E676;
      --accent-h: #00FF88;
      --btn-fg: #080808;
      --grain: 0.028;
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

    /* Forms & Cards */
    .form-card, .dashboard-card {
      background: var(--bg-card); border: 1px solid var(--border-hi);
      padding: 32px; display: flex; flex-direction: column; gap: 20px;
      border-radius: 8px;
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

    .dashboard-card h2 { font-family:'Syne'; font-size:18px; font-weight:800; }
    .dashboard-card p { font-family:'Space Mono'; font-size:12px; color:var(--text-sub); line-height:1.4; }
    .dashboard-card a div { text-align:center; }
  </style>
</head>
<body>

@php
use App\Models\MerchantProfile;
use App\Models\AgentProfile;

$merchant = MerchantProfile::where('user_id', auth()->id())->first();
$agent = AgentProfile::where('user_id', auth()->id())->first();
@endphp

<div class="onboarding-container">
  <div class="header">
    <span class="wordmark">CLERK // ACCESS</span>
    <h1 class="title">Complete your<br>enrollment.</h1>
  </div>

  <!-- Switcher -->
  <div class="role-toggle" id="role-toggle" data-active="{{$role}}">
    <div class="toggle-slider"></div>
    <button class="role-btn active" id="btn-merchant" onclick="setRole('merchant')">Merchant</button>
    <button class="role-btn" id="btn-agent" onclick="setRole('agent')">Agent</button>
  </div>

  <!-- MERCHANT -->
  @if($merchant)
    <div id="merchant-msg" class="dashboard-card">
      <h2>Merchant Profile Found</h2>
      <p>You already have a merchant profile (status: {{ strtoupper($merchant->status) }}).<br>
         Visit your dashboard to manage your store and products.</p>
      <a href="{{ route('merchant.dashboard') }}" style="text-decoration:none;">
        <div style="padding:12px 20px; background:var(--accent); color:var(--btn-fg); font-family:'Space Mono'; font-weight:700; text-transform:uppercase; border-radius:4px; cursor:pointer;">
          Visit Dashboard
        </div>
      </a>
    </div>
  @else
  <form id="form-merchant" class="form-card" method='post' action="{{route('merchant.profile.store')}}">
      @csrf
      @if (session()->has('error'))
        <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
            {{ session('error') }}
        </span>
      @endif
    <div class="input-group">
      <label>Business Name</label>
      @if ($errors->has('business_name'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_name') }}
    </span>
      @endif
      <input type="text" name="business_name" value="{{old('business_name')}}" placeholder="Acme Corp" required>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div class="input-group">
            <label>Business Phone</label>
            @if ($errors->has('business_phone'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_phone') }}
    </span>
      @endif
            <input type="tel" name="business_phone" value="{{old('business_phone')}}" placeholder="+234...">
        </div>
        <div class="input-group">
            <label>Business Email</label>
            @if ($errors->has('business_email'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_email') }}
    </span>
      @endif
            <input type="email" name="business_email" value="{{old('business_email')}}" placeholder="hi@acme.com">
        </div>
    </div>

    <div class="input-group">
        <label>Business Address</label>
        @if ($errors->has('business_address'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_address') }}
    </span>
      @endif
        <input type="text" name="business_address" value="{{old('business_address')}}" placeholder="Physical location">
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 16px;">
        <div class="input-group">
            <label>Settlement Account Number</label>
            @if ($errors->has('business_account_number'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('business_account_number') }}
    </span>
      @endif
            <input type="text" name="business_account_number" value="{{old('business_account_name')}}" placeholder="0000000000" required>
        </div>
        <div class="input-group">
            <label>Bank</label>
            @if ($errors->has('bank'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('bank') }}
    </span>
      @endif
            <input type="text" name="bank" value="{{old('bank')}}" placeholder="Access Bank" required>
        </div>
    </div>

    <button type="submit" class="btn-submit">Initialize Merchant Account</button>
  </form>
  @endif

  <!-- AGENT -->
  @if($agent)
    <div id="agent-msg" class="dashboard-card">
      <h2>Agent Profile Found</h2>
      <p>You already have an agent profile (status: {{ strtoupper($agent->status) }}).<br>
         Visit your dashboard to start accepting orders.</p>
      <a href="{{ route('agent.panel') }}" style="text-decoration:none;">
        <div style="padding:12px 20px; background:var(--accent); color:var(--btn-fg); font-family:'Space Mono'; font-weight:700; text-transform:uppercase; border-radius:4px; cursor:pointer;">
          Visit Dashboard
        </div>
      </a>
    </div>
  @else
  <form id="form-agent" class="form-card hidden" method="post" action='{{route('agent.profile.store')}}'>
      @csrf
      @if (session()->has('error'))
        <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
            {{ session('error') }}
        </span>
      @endif
    <div class="input-group">
      <label>Full Legal Name</label>
      @if ($errors->has('full_name'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('full_name') }}
    </span>
      @endif
      <input type="text" name="full_name" value="{{old('full_name')}}" placeholder="John Doe" required>
    </div>

    <div class="input-group">
      <label>Phone Number</label>
      @if ($errors->has('phone'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('phone') }}
    </span>
      @endif
      <input type="tel" name="phone" value="{{old('phone')}}" placeholder="+234..." required>
    </div>

    <div class="input-group">
        <label>Residential Address</label>
        @if ($errors->has('address'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('address') }}
    </span>
      @endif
        <input type="text" name="address" value="{{old('address')}}" placeholder="Lagos, Nigeria">
    </div>

    <div class="input-group">
        <label>Primary Bank Account</label>
        @if ($errors->has('connected_bank_accounts'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('connected_bank_accounts') }}
    </span>
      @endif
        <input type="text" name="connected_bank_accounts" value="{{old('connected_bank_accounts')}}" placeholder="Bank Name — Account Number">
    </div>
    <div class="input-group">
        <label>Google map link (optional) </label>
        @if ($errors->has('google_map_link'))
    <span style="font-family: 'Space Mono', monospace; font-size: 9px; color: var(--red); text-transform: uppercase; margin-top: 4px; display: block;">
        {{ $errors->first('google_map_link') }}
    </span>
      @endif
        <input type="text" name="google_map_link" value="{{old('google_map_link')}}" placeholder="Bank Name — Account Number">
    </div>

    <button type="submit" class="btn-submit">Activate Agent Terminal</button>
  </form>
  @endif
</div>

<script>
// function setRole(role){
//   const toggle = document.getElementById('role-toggle');
//   const merchantForm = document.getElementById('form-merchant');
//   const agentForm = document.getElementById('form-agent');
//   const btnM = document.getElementById('btn-merchant');
//   const btnA = document.getElementById('btn-agent');
//   const Agent = document.getElementById('agent-msg');
//   const MerchantMsg = document.getElementById('merchant-msg');

//   toggle.setAttribute('data-active', role);

//   if(role === 'merchant'){
//     Agent.classList.add('hidden');
//     MerchantMsg.classList.remove('hidden');
//     merchantForm?.classList.remove('hidden');
//     agentForm?.classList.add('hidden');
//     btnM.classList.add('active');
//     btnA.classList.remove('active');
//   } else {
//     Agent.classList.remove('hidden');
//     MerchantMsg.classList.add('hidden');
//     merchantForm?.classList.add('hidden');
//     agentForm?.classList.remove('hidden');
//     btnM.classList.remove('active');
//     btnA.classList.add('active');
//   }
// }
function setRole(role){
  const toggle = document.getElementById('role-toggle');

  const merchantForm = document.getElementById('form-merchant');
  const agentForm = document.getElementById('form-agent');

  const agentMsg = document.getElementById('agent-msg');
  const merchantMsg = document.getElementById('merchant-msg');

  const btnM = document.getElementById('btn-merchant');
  const btnA = document.getElementById('btn-agent');

  toggle.setAttribute('data-active', role);

  if(role === 'merchant'){

    if(agentMsg) agentMsg.classList.add('hidden');
    if(merchantMsg) merchantMsg.classList.remove('hidden');

    if(merchantForm) merchantForm.classList.remove('hidden');
    if(agentForm) agentForm.classList.add('hidden');

    btnM.classList.add('active');
    btnA.classList.remove('active');

  } else {

    if(agentMsg) agentMsg.classList.remove('hidden');
    if(merchantMsg) merchantMsg.classList.add('hidden');

    if(merchantForm) merchantForm.classList.add('hidden');
    if(agentForm) agentForm.classList.remove('hidden');

    btnM.classList.remove('active');
    btnA.classList.add('active');
  }
}
window.onload = ()=>{
  const preferredRole = document.getElementById('role-toggle').dataset.active;
  setRole(preferredRole);
};
</script>

</body>
</html>