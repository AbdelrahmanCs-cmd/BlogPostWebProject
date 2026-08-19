 <aside class="sidebar" id="sidebar">

     <!-- Brand -->
     <div class="brand">
         <div class="brand-mark">L</div>
         <div>
             <div class="brand-text">LBAS</div>
             <div class="brand-sub">Blog Admin</div>
         </div>
     </div>

     <!-- Overview -->
     <div class="nav-label">Overview</div>

     <ul class="nav">
         <li>
             <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <rect x="3" y="3" width="7" height="9" />
                     <rect x="14" y="3" width="7" height="5" />
                     <rect x="14" y="12" width="7" height="9" />
                     <rect x="3" y="16" width="7" height="5" />
                 </svg>
                 Dashboard
             </a>
         </li>
     </ul>

     <!-- Content -->
     <div class="nav-label">Content</div>

     <ul class="nav">
         <li>
             <a href="posts-index.html" class="nav-link">
                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                     <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                 </svg>
                 Posts
             </a>
         </li>

         <li>
             <a href="{{ route('theme.index') }}" class="nav-link">
                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <circle cx="12" cy="12" r="9" />
                     <path d="M3 12h18" />
                     <path d="M12 3c2.5 2.7 4 6 4 9s-1.5 6.3-4 9c-2.5-2.7-4-6-4-9s1.5-6.3 4-9z" />
                 </svg>
                 Public Blog
             </a>
         </li>
     </ul>

     <!-- Administration -->
     <div class="nav-label">Administration</div>

     <ul class="nav">
         @can('view', App\Models\User::class)
             <li>
                 <a href="{{ route('users.index') }}"
                     class="nav-link {{ request()->routeIs('users.index') ? 'is-active' : '' }}">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                         <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                         <circle cx="9" cy="7" r="4" />
                         <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                     </svg>
                     Users
                 </a>
             </li>
         @endcan
         <li>
             <a href="{{ route('profile.edit') }}"
                 class="nav-link {{ request()->routeIs('profile.edit') ? 'is-active' : '' }}">
                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <circle cx="12" cy="8" r="4" />
                     <path d="M4 21c0-4 4-7 8-7s8 3 8 7" />
                 </svg>
                 Profile
             </a>
         </li>
     </ul>

     <!-- Footer -->
     <div class="sidebar-foot">
         <div class="role-chip">
             <span class="dot"></span>
             <span id="sidebarRoleLabel">{{ Auth::user()->role }}</span>
         </div>
         <form action="{{ route('logout') }}" method="POST">
             @csrf
             <button class="logout-btn" type="submit">
                 <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2">
                     <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                     <path d="M16 17l5-5-5-5" />
                     <path d="M21 12H9" />
                 </svg>
                 Log out
             </button>
         </form>
     </div>


 </aside>
