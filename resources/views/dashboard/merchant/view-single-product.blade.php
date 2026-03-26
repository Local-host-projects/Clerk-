<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Merchant Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #0A0A0A; --bg-off: #111; --border: #222; --text: #F5F5F0; 
      --text-muted: #555; --accent: #00E676; --accent-hover: #00ff85; --btn-text: #0A0A0A;
      --danger: #ff4444;
    }
    [data-theme="light"] {
      --bg: #F4F3EF; --bg-off: #ECEAE5; --border: #D0CEC8; --text: #111; 
      --text-muted: #888; --accent: #007A38; --accent-hover: #009444; --btn-text: #FFF;
    }

    body { 
      background: var(--bg); color: var(--text); font-family: 'Syne', sans-serif; 
      margin: 0; min-height: 100vh; display: flex; flex-direction: column; 
    }
    .mono { font-family: 'Space Mono', monospace; }

    /* Header */
    .clerk-header { 
      border-bottom: 1px solid var(--border); padding: 18px 32px; 
      display: flex; justify-content: space-between; align-items: center; 
    }
    .clerk-wordmark { font-weight: 800; letter-spacing: 0.15em; }
    .clerk-wordmark span { color: var(--accent); }
    .header-meta { font-family: 'Space Mono'; font-size: 10px; color: var(--text-muted); border: 1px solid var(--border); padding: 4px 10px; }
    
    .theme-toggle { 
      background: none; border: 1px solid var(--border); color: var(--text-muted); 
      cursor: pointer; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    }

    /* Grid Layout */
    .checkout-grid { 
      display: grid; grid-template-columns: 1fr 1px 400px; 
      max-width: 1080px; width: 100%; margin: 0 auto; flex: 1; 
    }
    .divider-v { background: var(--border); }
    .panel-left { padding: 48px 40px; }
    .panel-right { padding: 48px 36px; }
    .eyebrow { font-family: 'Space Mono'; font-size: 10px; color: var(--text-muted); margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.1em; }

    /* Components */
    .product-img-hero { width: 100%; aspect-ratio: 16/9; background: var(--bg-off); border: 1px solid var(--border); object-fit: cover; margin-bottom: 32px; }
    
    .status-badge {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 4px 10px; border: 1px solid var(--accent);
      color: var(--accent); font-family: 'Space Mono'; font-size: 10px;
      margin-bottom: 16px;
    }

    .c-block { border: 1px solid var(--border); margin-bottom: 24px; }
    .c-row { display: flex; justify-content: space-between; padding: 16px 18px; border-bottom: 1px solid var(--border); font-family: 'Space Mono'; font-size: 12px; }
    .c-row:last-child { border-bottom: none; }
    .c-label { color: var(--text-muted); font-size: 10px; }
    .c-value { color: var(--text); font-weight: 700; }

    .btn-action { 
      width: 100%; background: var(--bg-off); color: var(--text); border: 1px solid var(--border); 
      padding: 16px; font-weight: 700; font-family: 'Space Mono'; font-size: 11px;
      text-transform: uppercase; cursor: pointer; text-align: center; margin-bottom: 12px;
      transition: all 0.2s;
    }
    .btn-action:hover { border-color: var(--text-muted); background: var(--bg); }
    .btn-primary { background: var(--accent); color: var(--btn-text); border: none; }
    .btn-primary:hover { background: var(--accent-hover); }

    /* Modal Styles */
    .modal-overlay {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(4px);
      display: none; justify-content: center; align-items: center; z-index: 999;
      opacity: 0; transition: opacity 0.2s ease;
    }
    .modal-overlay.active {
      display: flex; opacity: 1;
    }
    .modal-content {
      background: var(--bg); border: 1px solid var(--border);
      width: 100%; max-width: 500px; padding: 40px; box-sizing: border-box;
      max-height: 90vh; overflow-y: auto;
    }
    .modal-header {
      display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;
    }
    
    /* Form Styles */
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-family: 'Space Mono'; font-size: 10px; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; }
    .form-input {
      width: 100%; background: var(--bg-off); color: var(--text);
      border: 1px solid var(--border); padding: 14px; font-family: 'Syne'; font-size: 14px;
      box-sizing: border-box; outline: none; transition: border-color 0.2s;
    }
    .form-input:focus { border-color: var(--accent); }
    .form-input.mono { font-family: 'Space Mono'; font-size: 12px; }
    textarea.form-input { resize: vertical; min-height: 100px; }

    @media (max-width: 768px) {
      .checkout-grid { grid-template-columns: 1fr; }
      .divider-v { display: none; }
    }
  </style>
</head>

<body>

  <header class="clerk-header">
    <div class="clerk-wordmark">CLR<span>K</span></div>
    <div style="display: flex; align-items: center; gap: 15px;">
      <div class="header-meta">{{ucwords($product->name)}}</div>
      <button class="theme-toggle" id="theme-btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
      </button>
    </div>
  </header>

  <main class="checkout-grid">
    <section class="panel-left">
      <p class="eyebrow">Product Catalog /<a href="{{route('merchant.products')}}"> View</a></p>
      
      <img src="{{ asset('storage/products/'.$product->image_url) }}" alt="Product Hero" class="product-img-hero">
      
      <div class="status-badge">
        <span style="width: 6px; height: 6px; background: var(--accent); border-radius: 50%;"></span>
        ACTIVE ON STOREFRONT
      </div>

      <h1 style="font-size: 42px; font-weight: 800; margin: 0 0 20px 0; line-height: 1;">{{ucwords($product->name)}}</h1>
      
      <p class="mono" style="font-size: 13px; color: var(--text-muted); line-height: 1.8; max-width: 500px;">
        {{$product->description}}
      </p>

        <div style="margin-top: 40px; display: flex; gap: 10px;">
        <div style="flex: 1; border: 1px solid var(--border); padding: 20px;">
            <p class="eyebrow" style="margin-bottom: 10px;">Last Updated</p>
            <span class="mono" style="font-size: 14px;">{{ $product->updated_at->format('M d, Y') }}</span>
        </div>

        <div style="flex: 1; border: 1px solid var(--border); padding: 20px; display: flex; flex-direction: column;">
            <p class="eyebrow" style="margin-bottom: 10px;">Public Share Link</p>
            <div style="display: flex; align-items: center; background: var(--bg-off); border: 1px solid var(--border); padding: 5px 5px 5px 12px;">
            <input type="text" readonly id="share-link" 
                    value="{{ route('product.checkout',['id'=>$product->id]) }}" 
                    style="background: none; border: none; color: var(--text-muted); font-family: 'Space Mono'; font-size: 11px; flex: 1; outline: none;">
            
            <button onclick="copyLink()" id="copy-btn"
                    style="background: var(--bg); border: 1px solid var(--border); color: var(--accent); font-family: 'Space Mono'; font-size: 9px; padding: 8px 12px; cursor: pointer; text-transform: uppercase; transition: all 0.2s;">
                Copy
            </button>
            </div>
        </div>
        </div>
    </section>

    <div class="divider-v"></div>

    <section class="panel-right">
      <p class="eyebrow">Inventory Stats</p>

      <div class="c-block">
          <div class="c-row">
            <span class="c-label">RETAIL PRICE</span>
            <span class="c-value" style="color: var(--accent); font-size: 18px;">
                ₦{{ number_format($product->price) }}.00
            </span>
          </div>

          <div class="c-row">
            <span class="c-label">INVENTORY</span>
            <span class="c-value">
                @if($product->stock == 0)
                NON-LIMITED
                @else
                {{ $product->stock }} UNITS
                @endif
            </span>
          </div>

          <div class="c-row">
            <span class="c-label">PRODUCT TYPE</span>
            <span class="c-value" style="text-transform: uppercase;">
                {{ $product->type }}
            </span>
          </div>
      </div>

      <p class="eyebrow">Quick Actions</p>
      
      <div style="display: flex; flex-direction: column; gap: 8px;">
          <button class="btn-action btn-primary" id="open-edit-btn">Edit Product Details</button>
      </div>
    </section>
  </main>

  <div class="modal-overlay" id="edit-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 style="margin: 0; font-size: 24px;">Edit Data</h2>
        <button id="close-modal-btn" style="background: none; border: none; color: var(--text-muted); cursor: pointer; font-family: 'Space Mono'; font-size: 24px;">×</button>
      </div>

<form method="post" action="{{route('merchant.update.product',['id'=>$product->id])}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label class="form-label">Product Image</label>
    <div id="dropify-wrapper" style="position: relative; width: 100%; height: 160px; border: 1px dashed var(--border); background: var(--bg-off); display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; transition: border-color 0.2s;">
      
      <img id="img-preview" src="#" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1;">
      
      <div id="dropify-text" style="text-align: center; z-index: 2; pointer-events: none;">
        <p class="mono" style="font-size: 10px; margin: 0; color: var(--text-muted);">DRAG & DROP OR CLICK</p>
        <p class="mono" style="font-size: 8px; margin: 5px 0 0 0; color: var(--accent);">[ PNG, JPG, WEBP ]</p>
      </div>

      <input type="file" name="image" id="product-image-input" accept="image/*" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 3;">
    </div>
    <button type="button" id="remove-img" style="display: none; background: none; border: none; color: var(--danger); font-family: 'Space Mono'; font-size: 9px; margin-top: 8px; cursor: pointer; text-transform: uppercase;">[ Remove Image ]</button>
  </div>

  <div class="form-group">
    <label class="form-label">Product Name</label>
    <input type="text" name="name" class="form-input" value="{{ $product->name }}">
  </div>

  <div class="form-group">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-input mono">{{ $product->description }}</textarea>
  </div>

  <div style="display: flex; gap: 15px;">
    <div class="form-group" style="flex: 1;">
      <label class="form-label">Price (₦)</label>
      <input type="number" name="price" class="form-input mono" value="{{ $product->price }}">
    </div>

    <div class="form-group" style="flex: 1;">
      <label class="form-label">Stock Units</label>
      <input type="number" name="stock" class="form-input mono" value="{{ $product->stock }}">
    </div>
  </div>

  <div class="form-group">
    <label class="form-label">Product Type</label>
    <input type="text" name="type" class="form-input" value="{{ $product->type }}">
  </div>

  <button type="submit" class="btn-action btn-primary" style="margin-top: 10px;">Save Changes →</button>
</form>
    </div>
  </div>

  <script>
  function copyLink() {
  const copyText = document.getElementById("share-link");
  const btn = document.getElementById("copy-btn");

  // Select the text
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy to clipboard
  navigator.clipboard.writeText(copyText.value).then(() => {
    // Visual feedback
    const originalText = btn.innerText;
    btn.innerText = "COPIED";
    btn.style.borderColor = "var(--accent)";
    
    setTimeout(() => {
      btn.innerText = originalText;
      btn.style.borderColor = "var(--border)";
    }, 2000);
  });
}
    // Theme Toggle
    document.getElementById('theme-btn').addEventListener('click', () => {
      const root = document.documentElement;
      root.dataset.theme = root.dataset.theme === 'dark' ? 'light' : 'dark';
    });

    // Modal Logic
    const editModal = document.getElementById('edit-modal');
    const openBtn = document.getElementById('open-edit-btn');
    const closeBtn = document.getElementById('close-modal-btn');

    // Open Modal
    openBtn.addEventListener('click', () => {
      editModal.classList.add('active');
      document.body.style.overflow = 'hidden'; // Prevents background scrolling
    });

    // Close Modal
    closeBtn.addEventListener('click', () => {
      editModal.classList.remove('active');
      document.body.style.overflow = 'auto';
    });

    // Close if clicking outside the modal content
    editModal.addEventListener('click', (e) => {
      if (e.target === editModal) {
        editModal.classList.remove('active');
        document.body.style.overflow = 'auto';
      }
    });
    const imageInput = document.getElementById('product-image-input');
const imagePreview = document.getElementById('img-preview');
const dropifyText = document.getElementById('dropify-text');
const dropifyWrapper = document.getElementById('dropify-wrapper');
const removeBtn = document.getElementById('remove-img');

imageInput.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
      imagePreview.src = e.target.result;
      imagePreview.style.display = 'block';
      dropifyText.style.display = 'none';
      removeBtn.style.display = 'block';
      dropifyWrapper.style.borderColor = 'var(--accent)';
    }
    
    reader.readAsDataURL(file);
  }
});

// Remove image functionality
removeBtn.addEventListener('click', () => {
  imageInput.value = "";
  imagePreview.style.display = 'none';
  dropifyText.style.display = 'block';
  removeBtn.style.display = 'none';
  dropifyWrapper.style.borderColor = 'var(--border)';
});

// Drag & Drop visual feedback
imageInput.addEventListener('dragenter', () => dropifyWrapper.style.borderColor = 'var(--accent)');
imageInput.addEventListener('dragleave', () => dropifyWrapper.style.borderColor = 'var(--border)');
  </script>

</body>
</html>