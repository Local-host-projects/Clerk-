@extends('layout.merchant')
@section('title')
    Projects
@endsection
@section('main')
<main class="main">
    <div class="view-header">
      <div>
        <h1 class="view-title">Projects</h1>
        <p class="view-sub">Manage your integration environments</p>
      </div>
      <button class="btn-primary">+ Create New Project</button>
    </div>

    <!-- Project List Table -->
    <div class="project-list">
      <div class="project-row" onclick="openProject('E-Commerce Main API', 'prj_live_92817552')">
        <div class="project-info">
          <span class="project-name">E-Commerce Main API</span>
          <span class="project-id">ID: prj_live_92817552</span>
        </div>
        <div class="project-actions">
          <button class="action-btn" onclick="event.stopPropagation(); openRenameModal('E-Commerce Main API')">Rename</button>
          <button class="action-btn delete" onclick="event.stopPropagation(); deleteProject()">Delete</button>
        </div>
      </div>

      <div class="project-row" onclick="openProject('Mobile App V2', 'prj_live_00192837')">
        <div class="project-info">
          <span class="project-name">Mobile App V2</span>
          <span class="project-id">ID: prj_live_00192837</span>
        </div>
        <div class="project-actions">
          <button class="action-btn" onclick="event.stopPropagation(); openRenameModal('Mobile App V2')">Rename</button>
          <button class="action-btn delete" onclick="event.stopPropagation(); deleteProject()">Delete</button>
        </div>
      </div>

      <div class="project-row" onclick="openProject('Internal Settlement Tool', 'prj_test_77162551')">
        <div class="project-info">
          <span class="project-name">Internal Settlement Tool</span>
          <span class="project-id">ID: prj_test_77162551</span>
        </div>
        <div class="project-actions">
          <button class="action-btn" onclick="event.stopPropagation(); openRenameModal('Internal Settlement Tool')">Rename</button>
          <button class="action-btn delete" onclick="event.stopPropagation(); deleteProject()">Delete</button>
        </div>
      </div>
    </div>
</main>


<!-- Modal: Project Configuration -->

@endsection
@section('modal')
    <div class="modal-overlay" id="project-modal">
  <div class="modal-card">
    <h2 id="modal-project-title">Project Settings</h2>
    
    <!-- Per-Project Push Webhook -->
    <div class="integration-card">
      <span class="card-label">Clerk Push Webhook</span>
      <div class="copy-box">
        <span class="copy-text" id="push-webhook-url">https://api.clerk.network/v1/webhook/push/prj_...</span>
        <button class="copy-btn" onclick="copyWebhook()">Copy</button>
      </div>
      <p style="font-size: 9px; color: var(--text-sub); font-family: 'Space Mono', monospace;">PUSH STATE UPDATES TO THIS ENDPOINT.</p>
    </div>

    <div class="input-group">
      <label>Order Creation Webhook</label>
      <input type="text" id="webhook-create" placeholder="https://your-api.com/webhooks/order-created">
    </div>

    <div class="input-group">
      <label>Order Completed Webhook</label>
      <input type="text" id="webhook-complete" placeholder="https://your-api.com/webhooks/order-resolved">
    </div>

    <div class="modal-footer">
      <button class="action-btn" onclick="closeModal('project-modal')">Cancel</button>
      <button class="btn-primary" onclick="saveWebhooks()">Save Changes</button>
    </div>
  </div>
</div>

<!-- Modal: Rename Project -->
<div class="modal-overlay" id="rename-modal">
  <div class="modal-card">
    <h2>Rename Project</h2>
    <div class="input-group">
      <label>New Project Name</label>
      <input type="text" id="new-project-name" placeholder="Enter name...">
    </div>
    <div class="modal-footer">
      <button class="action-btn" onclick="closeModal('rename-modal')">Cancel</button>
      <button class="btn-primary" onclick="confirmRename()">Update Name</button>
    </div>
  </div>
</div>
@endsection
@push('styles')
    <style>
    .main{ padding:40px; overflow-y:auto; display:flex; flex-direction:column; gap:40px; max-width: 1000px;}
.view-header{ display:flex; justify-content:space-between; align-items:flex-end; }
.view-title{ font-size:28px; font-weight:800; }
.view-sub{ font-family:'Space Mono', monospace; font-size:10px; color:var(--text-sub); margin-top:4px; text-transform: uppercase;}
    .project-list {
  display: flex; flex-direction: column; border: 1px solid var(--border); background: var(--bg-card);
}
.project-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 20px 24px; border-bottom: 1px solid var(--border);
  cursor: pointer; transition: background 0.2s;
}
.project-row:hover { background: var(--bg-hover); }
.project-row:last-child { border-bottom: none; }

.project-info { display: flex; flex-direction: column; gap: 4px; }
.project-name { font-weight: 700; font-size: 14px; }
.project-id { font-family: 'Space Mono', monospace; font-size: 10px; color: var(--text-sub); }

.project-actions { display: flex; gap: 12px; }
.action-btn {
  background: transparent; border: 1px solid var(--border); color: var(--text-sub);
  padding: 6px 12px; font-family: 'Space Mono', monospace; font-size: 9px;
  text-transform: uppercase; cursor: pointer; font-weight: 700;
}
.action-btn:hover { border-color: var(--text); color: var(--text); }
.action-btn.delete:hover { border-color: var(--red); color: var(--red); }

/* Integration Card inside Modal */
.integration-card {
  background: var(--bg-off); border: 1px solid var(--accent); padding: 16px;
  display: flex; flex-direction: column; gap: 12px; border-left-width: 4px;
}
.card-label { font-family: 'Space Mono', monospace; font-size: 10px; color: var(--accent); font-weight: 700; text-transform: uppercase; }
.copy-box {
  background: var(--bg-input); border: 1px solid var(--border-mid); padding: 10px 14px;
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.copy-text { font-family: 'Space Mono', monospace; font-size: 10px; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.copy-btn { color: var(--accent); cursor: pointer; font-size: 9px; font-family: 'Space Mono', monospace; font-weight: 700; border: none; background: none; text-transform: uppercase;}

/* Modal System */
.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,0.9); backdrop-filter: blur(4px);
  display: none; align-items: center; justify-content: center; z-index: 1000;
}
.modal-overlay.active { display: flex; }
.modal-card {
  background: var(--bg-card); border: 1px solid var(--border-hi); width: 500px; padding: 40px;
  display: flex; flex-direction: column; gap: 24px;
}
.modal-card h2 { font-weight: 800; font-size: 20px; }
.input-group { display: flex; flex-direction: column; gap: 8px; }
.input-group label { font-family: 'Space Mono', monospace; font-size: 9px; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.1em;}
input {
  background: var(--bg-input); border: 1px solid var(--border); padding: 14px;
  color: var(--text); font-family: 'Space Mono', monospace; font-size: 13px; outline: none;
}
input:focus { border-color: var(--accent); }

.btn-primary {
  background: var(--accent); color: var(--btn-fg); border: none; padding: 14px 24px;
  font-family: 'Syne', sans-serif; font-weight: 800; font-size: 12px; 
  text-transform: uppercase; cursor: pointer;
}
.btn-primary:hover { background: var(--accent-h); }
.modal-footer { display: flex; justify-content: flex-end; gap: 12px; margin-top: 8px; }
    </style>
@endpush
@push('scripts')
    <script>
  let activeProjectId = '';

  function openProject(name, id) {
    activeProjectId = id;
    document.getElementById('modal-project-title').innerText = name;
    document.getElementById('push-webhook-url').innerText = `https://api.clerk.network/v1/webhook/push/${id}`;
    document.getElementById('project-modal').classList.add('active');
  }

  function openRenameModal(oldName) {
    document.getElementById('new-project-name').value = oldName;
    document.getElementById('rename-modal').classList.add('active');
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
  }

  function saveWebhooks() {
    // Backend would handle this
    alert("Configurations saved for " + activeProjectId);
    closeModal('project-modal');
  }

  function confirmRename() {
    const name = document.getElementById('new-project-name').value;
    alert("Project rename request sent for: " + name);
    closeModal('rename-modal');
  }

  function deleteProject() {
    if(confirm("Are you sure you want to delete this project? This action cannot be undone.")) {
        alert("Project deletion requested.");
    }
  }

  function copyWebhook() {
    const text = document.getElementById('push-webhook-url').innerText;
    const dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
    
    const btn = document.querySelector('.copy-btn');
    btn.innerText = "Copied!";
    setTimeout(() => btn.innerText = "Copy", 2000);
  }
</script>
@endpush