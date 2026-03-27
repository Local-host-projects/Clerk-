@extends('layout.merchant')
@section('title')
    Profile
@endsection
@section('main')
    <main class="main">
    <div class="view-header">
      <div>
        <h1 class="view-title">Profile Settings</h1>
        <p class="view-sub">Manage your agent identity and business details</p>
      </div>
    </div>

    <div class="profile-grid">
        <!-- Avatar Section -->
        {{-- @dd($merchant); --}}
        <div class="avatar-column">
            <div class="avatar-preview">
                <!-- SVG placeholder for a user -->
                <svg id="avatar-placeholder" viewBox="0 0 24 24" fill="none" stroke="var(--text-sub)" stroke-width="1" style="width: 80px; height: 80px;">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                <img id="avatar-image" src="" style="display: none;">
            </div>
            <label class="btn-upload">
                Change Photo
                <input type="file" id="photo-input" hidden accept="image/*">
            </label>
            <p style="font-family:'Space Mono', monospace; font-size:9px; color:var(--text-sub); text-align: center;">JPG, PNG, OR GIF.<br>MAX 2MB.</p>
        </div>

        <!-- Form Section -->
        <form action="{{ route('merchant.profile.update') }}" method="POST">
            @method('PUT')
            @csrf
            {{-- $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('business_name');
            $table->string('business_email')->unique()->nullable();
            $table->string('business_phone')->unique()->nullable();
            $table->string('business_address')->nullable();
            $table->string('business_account_number');
            $table->string('bank'); --}}
            <div class="form-column">
                <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" id="biz-name" value="{{ $merchant->business_name }}">
                </div>
    
                <div class="form-group">
                    <label>Registered Email</label>
                    <input type="email" id="biz-email" value="{{ $merchant->business_email }}">
                </div>
    
                <div class="form-group">
                    <label>Contact Phone</label>
                    <input type="text" id="biz-phone" value="{{$merchant->business_phone}}">
                </div>
    
                <div class="form-group">
                    <label>Bank Account Number</label>
                    <input type="text" value="{{ $merchant->business_account_number }}" >
                </div>
                <div class="form-group">
                    <label>Bank Address</label>
                    <input type="text" value="{{ $merchant->business_address }}" >
                </div>
                <div class="form-group">
                    <label>Business Bank</label>
                    <input type="text" value="{{ $merchant->bank }}">
                </div>
    
                <div style="display: flex; align-items: center; gap: 20px;">
                    <button class="btn-primary" type="submit">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
  </main>
@endsection
@push('styles')
    <style>
        .main{ padding:32px; overflow-y:auto; display:flex; flex-direction:column; gap:32px; }
.view-header{ display:flex; justify-content:space-between; align-items:flex-end; }
.view-title{ font-size:24px; font-weight:800; }
.view-sub{ font-family:'Space Mono', monospace; font-size:10px; color:var(--text-sub); margin-top:4px; text-transform: uppercase;}

.profile-grid {
    display: grid;
    grid-template-columns: 200px 1fr;
    gap: 48px;
    max-width: 900px;
}

/* Avatar Section */
.avatar-column {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}
.avatar-preview {
    width: 160px;
    height: 160px;
    background: var(--bg-off);
    border: 1px solid var(--border);
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
.avatar-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.btn-upload {
    font-family: 'Space Mono', monospace;
    font-size: 10px;
    color: var(--accent);
    cursor: pointer;
    text-transform: uppercase;
    font-weight: 700;
    border: 1px solid var(--accent);
    padding: 6px 12px;
    transition: all 0.2s;
}
.btn-upload:hover {
    background: var(--accent);
    color: var(--btn-fg);
}

/* Form Section */
.form-column {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.form-group label {
    font-family: 'Space Mono', monospace;
    font-size: 10px;
    color: var(--text-sub);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}
input {
    background: var(--bg-input);
    border: 1px solid var(--border);
    padding: 14px;
    color: var(--text);
    font-family: 'Space Mono', monospace;
    font-size: 13px;
    outline: none;
    transition: border-color 0.2s;
}
input:focus {
    border-color: var(--accent);
}

.btn-primary {
    background: var(--accent);
    color: var(--btn-fg);
    border: none;
    padding: 14px 28px;
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    cursor: pointer;
    align-self: flex-start;
}
.btn-primary:hover {
    background: var(--accent-h);
}

.success-note {
    font-family: 'Space Mono', monospace;
    font-size: 11px;
    color: var(--accent);
    display: none;
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateX(-10px); }
    to { opacity: 1; transform: translateX(0); }
}

    </style>
@endpush
@push('scripts')
    <script>
    // Handle Photo Upload Preview
    document.getElementById('photo-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.getElementById('avatar-image');
                const placeholder = document.getElementById('avatar-placeholder');
                img.src = event.target.result;
                img.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush