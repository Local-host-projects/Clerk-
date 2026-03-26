@extends('layout.merchant')
@section('title')
    Products
@endsection
@section('main')
    <main class="main">
    <div class="view-header">
      <div>
        <h1 class="view-title">Inventory</h1>
      </div>
      <button class="btn-primary" onclick="openCreateModal()">+ Create Product</button>
    </div>

    <div class="tab-container">
      <div class="tab active" onclick="filterType('all')">All Products</div>
      <div class="tab" onclick="filterType('digital')">Digital</div>
      <div class="tab" onclick="filterType('physical')">Physical</div>
    </div>
    {{-- @dd($products) --}}
    <div class="product-grid" id="product-list">
      <!-- Mock Physical Product -->
      @foreach ($products as $product)
      {{-- <a href="{{route('merchant.showProduct',['id'=>$product->id])}}">
      <div class="product-card" data-type="{{$product->type}}">
          <div class="product-img-placeholder">
              @if($product->image_url)
                  <img src="{{ asset('storage/products/'.$product->image_url) }}" alt="{{ $product->name }}" class="product-img">
              @else
                  No Image
              @endif
          </div>
          <div class="product-meta">
              <span class="product-tag">{{ ucfirst($product->type) }}</span>
              <h3 class="product-name">{{ $product->name }}</h3>
              <span class="product-price">₦ {{ number_format($product->price) }}</span>
              @if($product->description)
                  <p class="product-description">{{ $product->description }}</p>
              @endif
          </div>
      </div>
      </a> --}}
      <a href="{{route('merchant.showProduct',['id'=>$product->id])}}" style="text-decoration: none; color: inherit;">
    <div class="product-card" data-type="{{$product->type}}">
        <div class="product-img-placeholder">
            @if($product->image_url)
                <img src="{{ asset('storage/products/'.$product->image_url) }}" alt="{{ $product->name }}" class="product-img">
            @else
                No Image
            @endif
        </div>
        <div class="product-meta">
            <span class="product-tag">{{ ucfirst($product->type) }}</span>
            <h3 class="product-name">{{ $product->name }}</h3>
            <span class="product-price">₦ {{ number_format($product->price) }}</span>
            @if($product->description)
                <p class="product-description">{{ $product->description }}</p>
            @endif
        </div>
    </div>
</a>
      @endforeach
    </div>
  </main>
@endsection
@section('modal')
    <div class="modal-overlay" id="create-modal">
  <div class="modal-card">
    <h2 id="modal-title">New Product</h2>
    
    <!-- Step 1: Choose Type -->
    <div id="step-1" class="type-selector">
      <div class="type-option" onclick="selectType('digital')">
        <h3>Digital</h3>
        <p>Software, Links, E-books</p>
      </div>
      <div class="type-option" onclick="selectType('physical')">
        <h3>Physical</h3>
        <p>Clothing, Hardware, Goods</p>
      </div>
    </div>
    <div id="step-2" class="hidden">
    {{-- 'merchant', 'name', 'description', 'price',
        'stock', 'image_url', 'type', 'variants', 'filepath', --}}
      <div style="display: flex; flex-direction: column; gap: 20px;">
      <form id="create-product-form" data-digital="{{ route('merchant.create.digital.product') }}"
      data-physical="{{ route('merchant.create.physical.product') }}" action="" method="post" enctype="multipart/form-data">
      @csrf
        <div class="input-group">
          <label>Product Name</label>
          <input type="text" name="name"  placeholder="e.g. Premium Subscription" required>
        </div>

        <div class="input-group">
          <label>Base Price (₦)</label>
          <input type="number" name="price" id="prod-price" placeholder="0.00" required>
        </div>
        <div class="input-group">
          <label>Description</label>
          <textarea name="description" rows='4' placeholder="Enter product description..."></textarea>
        </div>
        <div class="input-group">
              <label>Product Images</label>
              <input type="file" name="image" class="dropify" 
                    data-max-file-size="5M"
                    data-allowed-file-extensions="jpg jpeg png" required/>
        </div>
        <!-- Adaptive Section: Digital -->
        <div id="fields-digital" class="hidden">
            <div class="input-group">
                <label>Asset Delivery (Link or File)</label>
                <input type="text" name="filepath" placeholder="https://drive.google.com/...">
                <p style="font-size: 8px; color: var(--text-sub); margin-top: 4px; font-family: 'Space Mono';">CUSTOMERS RECEIVE THIS UPON SUCCESSFUL PAYMENT.</p>
            </div>
        </div>

        <!-- Adaptive Section: Physical -->
        <div id="fields-physical" class="hidden">
            <div class="input-group">
                <label>Stock Count</label>
                <input type="number" name='stock' placeholder="Available units">
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 20px;">
          <span class="action-btn" style="background:transparent; border:1px solid var(--border); color:var(--text-sub); padding:10px 20px; text-transform:uppercase; font-family:'Space Mono'; font-size:10px; cursor:pointer;" onclick="resetModal()">Back</span>
          <button type="submit" class="btn-primary" >Complete Creation</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <style>
    .main{ padding:40px; overflow-y:auto; display:flex; flex-direction:column; gap:32px; }
.view-header{ display:flex; justify-content:space-between; align-items:flex-end; }
.view-title{ font-size:28px; font-weight:800; }
    .tab-container { display: flex; gap: 24px; border-bottom: 1px solid var(--border); }
.tab {
  padding: 12px 4px; font-family: 'Space Mono', monospace; font-size: 10px;
  text-transform: uppercase; color: var(--text-sub); cursor: pointer;
  border-bottom: 2px solid transparent; transition: all 0.2s;
}
.tab.active { color: var(--accent); border-bottom-color: var(--accent); }

/* Product Grid */
.product-grid {
  display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;
}
.product-card {
  background: var(--bg-card); border: 1px solid var(--border); padding: 20px;
  display: flex; flex-direction: column; gap: 16px; transition: transform 0.2s;
}
.product-card:hover { transform: translateY(-4px); border-color: var(--border-hi); }
.product-img-placeholder {
  aspect-ratio: 1;
  background: var(--bg-off);
  border: 1px dashed var(--border-mid);
  display: flex;
  align-items: center; 
  justify-content: center; 
  color: var(--text-sub);
  font-family: 'Space Mono', monospace; 
  font-size: 10px; 
  text-transform: uppercase;
  overflow: hidden; /* important for images */
}

.product-img-placeholder img.product-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.product-meta { display: flex; flex-direction: column; gap: 4px; }
.product-tag {
  font-family: 'Space Mono', monospace; font-size: 9px; padding: 2px 6px;
  background: var(--bg-input); border: 1px solid var(--border-mid); width: fit-content;
}
.product-name { font-weight: 800; font-size: 16px; }
.product-price { font-family: 'Space Mono', monospace; font-size: 14px; color: var(--accent); }
.product-description {
    font-family: 'Space Mono', monospace;
    font-size: 12px;
    color: var(--text-sub);
    margin-top: 8px;
    line-height: 1.4;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* limits to 3 lines */
    -webkit-box-orient: vertical;
}
/* Modal */
.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,0.95); backdrop-filter: blur(8px);
  display: none; align-items: center; justify-content: center; z-index: 1000;
}
.modal-overlay.active { display: flex; }
.modal-card {
  background: var(--bg-card); border: 1px solid var(--border-hi); width: 540px; padding: 40px;
  display: flex; flex-direction: column; gap: 24px; max-height: 90vh; overflow-y: auto;
}

/* Creation Logic Styles */
.type-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.type-option {
  border: 1px solid var(--border); padding: 24px; cursor: pointer; text-align: center;
  transition: all 0.2s;
}
.type-option:hover, .type-option.selected { border-color: var(--accent); background: var(--bg-off); }
.type-option h3 { font-size: 14px; font-weight: 800; margin-bottom: 4px; }
.type-option p { font-size: 10px; color: var(--text-sub); font-family: 'Space Mono', monospace; }

.input-group { display: flex; flex-direction: column; gap: 8px; }
.input-group label { font-family: 'Space Mono', monospace; font-size: 9px; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.1em;}
input, select, textarea {
  background: var(--bg-input); border: 1px solid var(--border); padding: 14px;
  color: var(--text); font-family: 'Space Mono', monospace; font-size: 13px; outline: none; width: 100%;
}
.btn-primary {
  background: var(--accent); color: var(--btn-fg); border: none; padding: 14px 24px;
  font-family: 'Syne', sans-serif; font-weight: 800; font-size: 12px; 
  text-transform: uppercase; cursor: pointer;
}
.hidden { display: none; }
    </style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
<script>
  $(document).ready(function() {
    $('.dropify').dropify({
      messages: {
        'default': 'Drag & drop files here or click',
        'replace': 'Drag & drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happened.'
      },
      error: {
        'fileSize': 'The file is too big.'
      }
    });
  });
</script>
    <script>
    const form = document.getElementById('create-product-form')
  function openCreateModal() {
    document.getElementById('create-modal').classList.add('active');
    resetModal();
  }

  function resetModal() {
    document.getElementById('step-1').classList.remove('hidden');
    document.getElementById('step-2').classList.add('hidden');
    document.getElementById('fields-digital').classList.add('hidden');
    document.getElementById('fields-physical').classList.add('hidden');
  }

  function selectType(type) {
    document.getElementById('step-1').classList.add('hidden');
    document.getElementById('step-2').classList.remove('hidden');
    
    if(type === 'digital') {
        document.getElementById('fields-digital').classList.remove('hidden');
        form.action = form.dataset.digital;
    } else {
        document.getElementById('fields-physical').classList.remove('hidden');
        form.action = form.dataset.physical;
    }
  }

  function submitProduct() {
    alert("Product added to inventory.");
    document.getElementById('create-modal').classList.remove('active');
  }

  window.onclick = function(event) {
    if (event.target == document.getElementById('create-modal')) {
        document.getElementById('create-modal').classList.remove('active');
    }
  }

  function filterType(type) {
    const cards = document.querySelectorAll('.product-card');
    const tabs = document.querySelectorAll('.tab');
    
    tabs.forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');

    cards.forEach(card => {
        if(type === 'all' || card.dataset.type === type) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
  }
</script>
@endpush