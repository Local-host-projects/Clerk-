<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — {{ $product->name }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #0A0A0A; --bg-off: #111; --border: #222; --text: #F5F5F0; 
      --text-muted: #555; --accent: #00E676; --accent-hover: #00ff85; --btn-text: #0A0A0A;
      --error: #FF5252;
    }
    [data-theme="light"] {
      --bg: #F4F3EF; --bg-off: #ECEAE5; --border: #D0CEC8; --text: #111; 
      --text-muted: #888; --accent: #007A38; --accent-hover: #009444; --btn-text: #FFF;
    }

    body { 
      background: var(--bg); color: var(--text); font-family: 'Syne', sans-serif; 
      margin: 0; min-height: 100vh; display: flex; flex-direction: column; 
      overflow-x: hidden;
    }
    .mono { font-family: 'Space Mono', monospace; }

    /* Header */
    .clerk-header { 
      border-bottom: 1px solid var(--border); padding: 18px 32px; 
      display: flex; justify-content: space-between; align-items: center; 
      position: sticky; top: 0; background: var(--bg); z-index: 50;
    }
    .clerk-wordmark { font-weight: 800; letter-spacing: 0.15em; font-size: 1.2rem; }
    .clerk-wordmark span { color: var(--accent); }
    
    .theme-toggle { 
      background: none; border: 1px solid var(--border); color: var(--text-muted); 
      cursor: pointer; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    }

    /* Grid Layout */
    .checkout-grid { 
      display: grid; grid-template-columns: 1fr 1px 400px; 
      max-width: 1150px; width: 100%; margin: 0 auto; flex: 1; 
    }
    .divider-v { background: var(--border); }
    .panel-left { padding: 60px 40px; }
    .panel-right { padding: 60px 36px; }
    .eyebrow { font-family: 'Space Mono'; font-size: 10px; color: var(--text-muted); margin-bottom: 24px; letter-spacing: 0.1em; }

    /* UI Components */
    .product-img { width: 100%; aspect-ratio: 1/1; background: var(--bg-off); border: 1px solid var(--border); object-fit: cover; margin-bottom: 32px; }
    .c-block { border: 1px solid var(--border); margin-bottom: 24px; }
    .c-row { display: flex; justify-content: space-between; padding: 14px 18px; border-bottom: 1px solid var(--border); font-family: 'Space Mono'; font-size: 11px; }
    .c-row:last-child { border-bottom: none; }
    .c-row.total { background: var(--bg-off); font-weight: bold; color: var(--accent); font-size: 18px; padding: 20px 18px; }

    .qty-row { display: flex; border: 1px solid var(--border); align-items: center; margin-bottom: 24px; }
    .qty-btn { background: none; border: none; color: var(--text); padding: 15px 20px; cursor: pointer; font-family: 'Space Mono'; font-size: 16px; transition: opacity 0.2s; }
    .qty-btn:hover { opacity: 0.6; }
    .qty-num { flex: 1; text-align: center; font-family: 'Space Mono'; font-weight: bold; }

    .btn-submit { 
      width: 100%; background: var(--accent); color: var(--btn-text); border: none; 
      padding: 24px; font-weight: 800; text-transform: uppercase; cursor: pointer; 
      display: flex; justify-content: space-between; font-family: 'Syne'; font-size: 14px;
      transition: transform 0.1s;
    }
    .btn-submit:active { transform: scale(0.98); }
    .btn-submit:hover { background: var(--accent-hover); }

    /* Modal Styles */
    #checkout-modal {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.85); backdrop-filter: blur(8px);
      display: none; align-items: center; justify-content: center; z-index: 100;
      padding: 20px;
    }
    .modal-content {
      background: var(--bg); border: 1px solid var(--border);
      width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto;
      padding: 40px; position: relative;
    }
    .close-modal {
      position: absolute; top: 20px; right: 20px; background: none; border: none;
      color: var(--text-muted); cursor: pointer; font-family: 'Space Mono'; font-size: 12px;
    }
    
    /* Form Styles */
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-family: 'Space Mono'; font-size: 9px; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; }
    .form-input {
      width: 100%; background: var(--bg-off); border: 1px solid var(--border);
      padding: 14px; color: var(--text); font-family: 'Space Mono'; font-size: 13px;
      box-sizing: border-box; outline: none;
    }
    .form-input:focus { border-color: var(--accent); }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

    @media (max-width: 850px) {
      .checkout-grid { grid-template-columns: 1fr; }
      .divider-v { display: none; }
      .panel-left { padding: 40px 24px; }
      .panel-right { border-top: 1px solid var(--border); padding: 40px 24px; }
    }

    @media (max-width: 480px) {
      .clerk-header { padding: 14px 20px; }
      .panel-left { padding: 32px 20px; }
      .panel-right { padding: 32px 20px; }
      .panel-left h1 { font-size: 28px !important; }
      .form-grid { grid-template-columns: 1fr; gap: 0; }
      .modal-content { padding: 28px 20px; }
      .btn-submit { padding: 18px 20px; font-size: 13px; }
      .c-row.total { font-size: 15px; padding: 16px 18px; }
    }
  </style>
</head>

<body>

  <header class="clerk-header">
    <div class="clerk-wordmark">CLR<span>K</span></div>
    <button class="theme-toggle" id="theme-btn" title="Toggle Theme">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
    </button>
  </header>

  <main class="checkout-grid">
    <section class="panel-left">
      <p class="eyebrow">PRODUCT_VIEW</p>
      <img src="{{ asset('storage/products/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
      <h1 style="font-size: 42px; margin-bottom: 16px; font-weight: 800; line-height: 1;">{{ $product->name }}</h1>
      <p class="mono" style="font-size: 13px; color: var(--text-muted); line-height: 1.8; max-width: 500px;">
        {{ $product->description }}
      </p>
      <div class="mono" style="margin-top: 24px; font-size: 11px; color: var(--accent);">
        SKU: CLRK-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
      </div>
    </section>

    <div class="divider-v"></div>

    <section class="panel-right">
      <p class="eyebrow">ORDER_SUMMARY</p>
      @if ($product->type == 'physical')    
      <div class="qty-row">
        <div class="mono" style="padding: 0 18px; color: var(--text-muted); font-size: 10px;">QUANTITY</div>
        <button type="button" class="qty-btn" id="qty-minus">−</button>
        <div class="qty-num" id="qty-display">1</div>
        <button type="button" class="qty-btn" id="qty-plus">+</button>
      </div>
      @endif

      <div class="c-block">
        <div class="c-row">
          <span>ITEM PRICE</span>
          <span>₦{{ number_format($product->price) }}</span>
        </div>
        <div class="c-row">
          <span>SUBTOTAL</span>
          <span id="display-subtotal">₦{{ number_format($product->price) }}</span>
        </div>
        <div class="c-row">
          <span>SERVICE FEE (1.5%)</span>
          <span id="display-fee">₦{{ number_format($product->price * 0.015) }}</span>
        </div>
        <div class="c-row total">
          <span style="color: var(--text); font-size: 10px; font-weight: 400;">EST. TOTAL</span>
          <span id="display-total">₦{{ number_format($product->price * 1.015) }}</span>
        </div>
      </div>

      <button type="button" class="btn-submit" id="open-checkout">
        <span>Proceed to Delivery</span>
        <span>→</span>
      </button>

      <div style="margin-top: 32px; font-family: 'Space Mono'; font-size: 10px; color: var(--text-muted); display: flex; align-items: center; gap: 10px; border-top: 1px solid var(--border); padding-top: 24px;">
        <div style="width: 8px; height: 8px; background: var(--accent); border-radius: 50%; box-shadow: 0 0 10px var(--accent);"></div>
        Encrypted via Clerk Secure Node
      </div>
    </section>
  </main>

  <!-- Checkout Modal -->
  <div id="checkout-modal">
    <div class="modal-content">
      <button class="close-modal" id="close-modal">[ CLOSE ]</button>
      <p class="eyebrow" style="margin-bottom: 32px;">DELIVERY_LOGISTICS_NG</p>
      
      <form action="{{ route('product.create.order') }}" method="POST" id="checkout-form">
        @csrf
        <!-- Hidden required data -->
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="merchant_id" value="{{ $product->merchant }}">
        <input type="hidden" name="quantity" id="hidden-qty" value="1">
        <input type="hidden" name="total_price" id="hidden-total" value="{{ $product->price * 1.015 }}">
        <input type="hidden" name="payment_method" value="clerk_direct">

        <!-- Personal Info -->
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input type="text" name="customer_name" class="form-input" placeholder="e.g. Chidi Okechukwu" required>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="customer_phone" class="form-input" placeholder="080..." required>
          </div>
          <div class="form-group">
            <label class="form-label">Email Address (Optional)</label>
            <input type="email" name="customer_email" class="form-input" placeholder="name@clerk.app">
          </div>
        </div>

        <!-- Location Info -->
        <div class="form-group">
          <label class="form-label">Delivery Address</label>
          <input type="text" name="address" class="form-input" placeholder="Street number and name" required>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-input" placeholder="Lagos" required>
          </div>
          <div class="form-group">
            <label class="form-label">Postal Code</label>
            <input type="text" name="postal_code" class="form-input" placeholder="100001">
          </div>
        </div>

        <div style="margin-bottom: 32px; padding: 15px; border: 1px dashed var(--border); text-align: center;">
            <p class="mono" style="font-size: 10px; margin: 0; color: var(--text-muted);">FINAL PAYABLE AMOUNT</p>
            <p id="modal-total-display" style="font-size: 24px; font-weight: 800; color: var(--accent); margin: 5px 0;">₦{{ number_format($product->price * 1.015) }}</p>
        </div>

        <button type="submit" class="btn-submit">
          <span>Authorize Payment</span>
          <span>₦</span>
        </button>
      </form>
    </div>
  </div>

  <script>
    // State
    let qty = 1;
    const unitPrice = {{ $product->price }};
    const feeRate = 0.015;

    // Elements
    const qtyDisplay = document.getElementById('qty-display');
    const hiddenQty = document.getElementById('hidden-qty');
    const hiddenTotal = document.getElementById('hidden-total');
    
    const subtotalDisplay = document.getElementById('display-subtotal');
    const feeDisplay = document.getElementById('display-fee');
    const totalDisplay = document.getElementById('display-total');
    const modalTotalDisplay = document.getElementById('modal-total-display');

    const modal = document.getElementById('checkout-modal');
    const openBtn = document.getElementById('open-checkout');
    const closeBtn = document.getElementById('close-modal');

    const fmt = (n) => '₦' + Math.round(n).toLocaleString();

    function updateUI() {
      const subtotal = qty * unitPrice;
      const fee = subtotal * feeRate;
      const total = subtotal + fee;

      qtyDisplay.innerText = qty;
      hiddenQty.value = qty; 
      hiddenTotal.value = total.toFixed(2);
      
      subtotalDisplay.innerText = fmt(subtotal);
      feeDisplay.innerText = fmt(fee);
      totalDisplay.innerText = fmt(total);
      modalTotalDisplay.innerText = fmt(total);
    }

    // Modal Logic
    openBtn.addEventListener('click', () => {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    });

    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    };

    // Qty Logic
    

    // Theme Toggle
    document.getElementById('theme-btn').addEventListener('click', () => {
      const root = document.documentElement;
      root.dataset.theme = root.dataset.theme === 'dark' ? 'light' : 'dark';
    });
    document.getElementById('qty-plus').addEventListener('click', () => {
      qty++;
      updateUI();
    });

    document.getElementById('qty-minus').addEventListener('click', () => {
      if (qty > 1) {
        qty--;
        updateUI();
      }
    });
  </script>

</body>
</html>