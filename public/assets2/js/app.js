/* ==========================================================
   LBAS — shared front-end behavior for the static prototype.

   BLADE NOTE
   ----------
   renderSidebar()/renderTopbar() below only exist because this
   is a plain HTML prototype with no templating engine. In Blade
   you don't need them at all — copy the strings they build into
   real partials once, as static markup:

     resources/views/partials/sidebar.blade.php
     resources/views/partials/topbar.blade.php

   and swap the {{ activeKey }} / {{ role }} placeholders for
   real Blade: request()->routeIs('posts.*'), auth()->user()->role,
   @can(...), etc. Everything else in this file (role-preview
   toggle, count-up, delete-confirm, slug generator, demo form
   submit) is genuine front-end behavior you keep as-is, moved
   into resources/js/app.js and compiled with Vite.
   ========================================================== */

const ICONS = {
  grid: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>',
  doc: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
  globe: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.7 4 6 4 9s-1.5 6.3-4 9c-2.5-2.7-4-6-4-9s1.5-6.3 4-9z"/></svg>',
  users: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
  user: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg>',
};

const NAV_GROUPS = [
  { label: 'Overview', items: [
    { key: 'dashboard', label: 'Dashboard', href: 'dashboard.html', icon: 'grid', roles: ['super_admin','editor','author'] },
  ]},
  { label: 'Content', items: [
    { key: 'posts', label: 'Posts', href: 'posts-index.html', icon: 'doc', roles: ['super_admin','editor','author'] },
    { key: 'public', label: 'Public Blog', href: 'blog-index.html', icon: 'globe', roles: ['super_admin','editor','author'] },
  ]},
  { label: 'Administration', items: [
    { key: 'users', label: 'Users', href: 'users-index.html', icon: 'users', roles: ['super_admin','editor'] },
    { key: 'profile', label: 'Profile', href: 'profile.html', icon: 'user', roles: ['super_admin','editor','author'] },
  ]},
];

const ROLE_LABELS = { super_admin: 'Super Admin', editor: 'Editor', author: 'Author' };

function renderSidebar(activeKey) {
  const groups = NAV_GROUPS.map(group => {
    const items = group.items.map(item => {
      const activeCls = item.key === activeKey ? ' is-active' : '';
      return `<li><a href="${item.href}" class="nav-link${activeCls}" data-nav-key="${item.key}" data-requires-role="${item.roles.join(',')}">
        ${ICONS[item.icon]} ${item.label}
      </a></li>`;
    }).join('');
    return `<div class="nav-label">${group.label}</div><ul class="nav">${items}</ul>`;
  }).join('');

  return `
    <div class="brand">
      <div class="brand-mark">L</div>
      <div>
        <div class="brand-text">LBAS</div>
        <div class="brand-sub">Blog Admin</div>
      </div>
    </div>
    ${groups}
    <div class="sidebar-foot">
      <div class="role-chip"><span class="dot"></span><span id="sidebarRoleLabel">Super Admin</span></div>
      <button class="logout-btn" type="button" data-action="logout">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
        Log out
      </button>
    </div>`;
}

function renderTopbar(eyebrow, title) {
  return `
    <div class="topbar-left">
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
      </button>
      <div>
        <div class="page-eyebrow">${eyebrow}</div>
        <div class="page-title">${title}</div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="role-preview">
        <span>Preview as</span>
        <select id="roleSwitcher">
          <option value="super_admin">Super Admin</option>
          <option value="editor">Editor</option>
          <option value="author">Author</option>
        </select>
      </div>
      <div class="avatar">S</div>
    </div>`;
}

function mountShell() {
  const sidebarEl = document.getElementById('sidebar');
  const topbarEl = document.getElementById('topbar');
  if (!sidebarEl || !topbarEl) return;

  const activeKey = document.body.dataset.activeNav || '';
  const eyebrow = document.body.dataset.pageEyebrow || '';
  const title = document.body.dataset.pageTitle || '';

  sidebarEl.innerHTML = renderSidebar(activeKey);
  topbarEl.innerHTML = renderTopbar(eyebrow, title);

  // Mobile sidebar toggle
  const menuToggle = document.getElementById('menuToggle');
  menuToggle.addEventListener('click', () => sidebarEl.classList.toggle('is-open'));
  document.addEventListener('click', (e) => {
    if (window.innerWidth <= 760 && sidebarEl.classList.contains('is-open')
        && !sidebarEl.contains(e.target) && e.target !== menuToggle) {
      sidebarEl.classList.remove('is-open');
    }
  });

  // Role preview (demo only — see note in applyRole)
  const roleSwitcher = document.getElementById('roleSwitcher');
  roleSwitcher.addEventListener('change', (e) => applyRole(e.target.value));
  applyRole('super_admin');

  // Fake logout confirmation
  const logoutBtn = sidebarEl.querySelector('[data-action="logout"]');
  logoutBtn.addEventListener('click', () => {
    // BLADE: this button is really a form: <form method="POST" action="{{ route('logout') }}">@csrf<button>Log out</button></form>
    alert('In the real app this submits a POST to /logout and redirects to /login.');
  });
}

/* ------------------------------------------------------------
   Role preview (front-end demo of RBAC-driven UI only).
   Server-side authorization (policies/gates/middleware) must
   still enforce every one of these rules on the route itself —
   this toggle exists so you can see the UI react, not as a
   substitute for real authorization. See assignment §3 / §6.
------------------------------------------------------------- */
function applyRole(role) {
  const label = document.getElementById('sidebarRoleLabel');
  if (label) label.textContent = ROLE_LABELS[role];

  document.querySelectorAll('[data-requires-role]').forEach(el => {
    const allowed = el.dataset.requiresRole.split(',');
    const permitted = allowed.includes(role);
    if (el.tagName === 'BUTTON') {
      el.toggleAttribute('disabled', !permitted);
    } else if (el.classList.contains('nav-link')) {
      el.classList.toggle('is-locked', !permitted);
    } else {
      el.style.display = permitted ? '' : 'none';
    }
  });

  document.body.dataset.currentRole = role;
  document.dispatchEvent(new CustomEvent('role-changed', { detail: { role } }));
}

/* ------------------------------------------------------------
   Count-up animation for dashboard stat cards.
------------------------------------------------------------- */
function initCountUp() {
  document.querySelectorAll('.stat-value[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count, 10);
    const duration = 700;
    const start = performance.now();
    function tick(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.round(target * eased);
      if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  });
}

/* ------------------------------------------------------------
   Delete confirmation. BLADE: replace the alert() with a real
   <form method="POST" action="{{ route('posts.destroy', $post) }}">
   @csrf @method('DELETE') submit, typically behind a confirm
   dialog or a small modal.
------------------------------------------------------------- */
function initConfirmDelete() {
  document.querySelectorAll('[data-confirm-delete]').forEach(btn => {
    btn.addEventListener('click', () => {
      const label = btn.dataset.confirmDelete || 'this item';
      if (confirm(`Delete ${label}? This cannot be undone.`)) {
        showFlash('success', `${label} deleted.`);
      }
    });
  });
}

/* ------------------------------------------------------------
   Flash message helper. BLADE: this is exactly what
   @if(session('success')) <div class="alert alert-success">
   {{ session('success') }}</div> @endif renders server-side.
------------------------------------------------------------- */
function showFlash(type, message) {
  const box = document.getElementById('flashBox');
  if (!box) return;
  box.textContent = message;
  box.className = `alert alert-${type}`;
  box.hidden = false;
  box.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

/* ------------------------------------------------------------
   Demo form submit — every create/edit form in this prototype
   has class "demo-form" and data-success-message. Submitting
   just shows the flash instead of actually posting anywhere.
   BLADE: delete this handler entirely; a real <form method="POST">
   posts to a resource controller's store()/update() method.
------------------------------------------------------------- */
function initDemoForms() {
  document.querySelectorAll('form.demo-form').forEach(form => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      showFlash('success', form.dataset.successMessage || 'Saved.');
    });
  });
}

/* ------------------------------------------------------------
   Slug auto-generation on the post create form. BLADE: keep this
   client-side nicety, but always regenerate/validate a unique
   slug server-side too (e.g. Str::slug($title), with a numeric
   suffix loop for duplicates) — never trust the client value.
------------------------------------------------------------- */
function initSlugGenerator() {
  const titleInput = document.getElementById('postTitle');
  const slugInput = document.getElementById('postSlug');
  if (!titleInput || !slugInput) return;
  let slugTouched = false;
  slugInput.addEventListener('input', () => { slugTouched = true; });
  titleInput.addEventListener('input', () => {
    if (slugTouched) return;
    slugInput.value = titleInput.value
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-');
  });
}

function initTodayDate() {
  const el = document.getElementById('todayDate');
  if (!el) return;
  el.textContent = new Date().toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

document.addEventListener('DOMContentLoaded', () => {
  mountShell();
  initTodayDate();
  initCountUp();
  initConfirmDelete();
  initDemoForms();
  initSlugGenerator();
});
