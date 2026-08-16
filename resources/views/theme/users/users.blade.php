@extends('theme.dashboard.partialDashboard.dashMaster')
@section('content')
    <div class="main-col-users">
        {{-- <header class="topbar" id="topbar"></header> --}}
        <main>
            <div class="alert alert-success" id="flashBox" hidden></div>

            <div class="toolbar">

                <form method="GET" action="{{ route('users.index') }}" class="toolbar-filters">

                    {{-- Search --}}
                    <div class="search-box">

                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">

                            <circle cx="11" cy="11" r="7" />
                            <path d="m21 21-4.3-4.3" />

                        </svg>

                        <input type="search" name="search" placeholder="Search by name or email"
                            value="{{ request('search') }}">

                    </div>


                    {{-- Role Filter --}}
                    <select class="filter-select" name="role" onchange="this.form.submit()">

                        <option value="">
                            All roles
                        </option>

                        <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>
                            Super Admin
                        </option>

                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>
                            User
                        </option>

                    </select>


                    {{-- Status Filter --}}
                    <select class="filter-select" name="status" onchange="this.form.submit()">

                        <option value="">
                            All statuses
                        </option>

                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>


                    {{-- Search Button --}}
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>


                    {{-- Clear Filters --}}
                    @if (request()->hasAny(['search', 'role', 'status']))
                        <a href="{{ route('users.index') }}" class="btn btn-ghost">
                            Clear
                        </a>
                    @endif

                </form>


                {{-- New User --}}
                <a class="btn btn-primary" href="{{ route('users.create') }}" data-requires-role="super_admin">

                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">

                        <path d="M12 5v14M5 12h14" />

                    </svg>

                    New user

                </a>

            </div>

            <div class="panel">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th></th>
                        </tr>
                    </thead>
                    {{-- BLADE: @foreach ($users as $user) @endforeach  --}}
                    <tbody>
                        @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                                <tr>

                                    <td>
                                        <div class="post-title">
                                            {{ $user->name }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $user->email }}
                                    </td>

                                    <td>
                                        <span class="badge badge-role-{{ $user->role }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>

                                    <td>

                                        <span class="badge badge-{{ $user->is_active ? 'active' : 'inactive' }}">

                                            {{ $user->is_active ? 'Active' : 'Inactive' }}

                                        </span>

                                    </td>

                                    <td>
                                        {{ $user->created_at->format('j M, Y') }}
                                    </td>

                                    <td>

                                        <div class="row-actions">

                                            {{-- View --}}
                                            <a class="icon-btn" href="{{ route('users.show', $user->id) }}" title="View">

                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">

                                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />

                                                    <circle cx="12" cy="12" r="3" />

                                                </svg>

                                            </a>


                                            {{-- Edit --}}
                                            <a class="icon-btn" href="{{ route('users.edit', $user->id) }}" title="Edit">

                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">

                                                    <path d="M12 20h9" />

                                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />

                                                </svg>

                                            </a>


                                            {{-- Delete --}}
                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="icon-btn danger"
                                                        title="Delete {{ $user->name }}">

                                                        <svg width="14" height="14" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2">

                                                            <path d="M3 6h18" />

                                                            <path
                                                                d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />

                                                        </svg>

                                                    </button>

                                                </form>
                                            @else
                                                {{-- Own account --}}
                                                <button class="icon-btn danger" title="You cannot delete your own account"
                                                    disabled>

                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">

                                                        <path d="M3 6h18" />

                                                        <path
                                                            d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />

                                                    </svg>

                                                </button>
                                            @endif

                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>

                                <td colspan="6" style="text-align: center;">
                                    No users found.
                                </td>

                            </tr>
                        @endif
                        {{-- <tr>
                            <td>
                                <div class="post-title">Sara Malik</div>
                            </td>
                            <td>sara@example.com</td>
                            <td><span class="badge badge-role-super">Super admin</span></td>
                            <td><span class="badge badge-active">Active</span></td>
                            <td>Jan 12, 2025</td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn" href="users-show.html" title="View"
                                        data-requires-role="super_admin,editor"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg></a>
                                    <a class="icon-btn" href="users-edit.html" title="Edit"
                                        data-requires-role="super_admin"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        </svg></a>
                                    <!-- Own account: delete disabled — "Prevent a logged-in administrator from accidentally deleting their own account" -->
                                    <button class="icon-btn danger" title="This is your own account" disabled>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18" />
                                            <path
                                                d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr> --}}
                        {{-- <td>
                                <div class="post-title">Marcus Reed</div>
                            </td>
                            <td>marcus@example.com</td>
                            <td><span class="badge badge-role-editor">Editor</span></td>
                            <td><span class="badge badge-active">Active</span></td>
                            <td>Mar 04, 2025</td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn" href="users-show.html" title="View"
                                        data-requires-role="super_admin,editor"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg></a>
                                    <a class="icon-btn" href="users-edit.html" title="Edit"
                                        data-requires-role="super_admin"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        </svg></a>
                                    <button class="icon-btn danger" title="Delete Marcus Reed"
                                        data-confirm-delete="Marcus Reed" data-requires-role="super_admin">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18" />
                                            <path
                                                d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="post-title">Priya Nair</div>
                            </td>
                            <td>priya@example.com</td>
                            <td><span class="badge badge-role-author">Author</span></td>
                            <td><span class="badge badge-active">Active</span></td>
                            <td>Jun 21, 2025</td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn" href="users-show.html" title="View"
                                        data-requires-role="super_admin,editor"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg></a>
                                    <a class="icon-btn" href="users-edit.html" title="Edit"
                                        data-requires-role="super_admin"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        </svg></a>
                                    <button class="icon-btn danger" title="Delete Priya Nair"
                                        data-confirm-delete="Priya Nair" data-requires-role="super_admin">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18" />
                                            <path
                                                d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="post-title">Jordan Trent</div>
                            </td>
                            <td>j.trent@example.com</td>
                            <td><span class="badge badge-role-author">Author</span></td>
                            <td><span class="badge badge-inactive">Inactive</span></td>
                            <td>Aug 30, 2025</td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn" href="users-show.html" title="View"
                                        data-requires-role="super_admin,editor"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg></a>
                                    <a class="icon-btn" href="users-edit.html" title="Edit"
                                        data-requires-role="super_admin"><svg width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        </svg></a>
                                    <button class="icon-btn danger" title="Delete Jordan Trent"
                                        data-confirm-delete="Jordan Trent" data-requires-role="super_admin">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18" />
                                            <path
                                                d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                {{-- BLADE: {{ $users->links() }}  --}}
                <div class="pagination">

                    <span>
                        Showing
                        {{ $users->firstItem() ?? 0 }}
                        –
                        {{ $users->lastItem() ?? 0 }}
                        of
                        {{ $users->total() }}
                        users
                    </span>


                    <div class="pages">

                        {{-- Previous --}}
                        @if ($users->onFirstPage())
                            <span class="disabled">
                                ‹
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}">
                                ‹
                            </a>
                        @endif


                        {{-- Page Numbers --}}
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="is-current">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach


                        {{-- Next --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}">
                                ›
                            </a>
                        @else
                            <span class="disabled">
                                ›
                            </span>
                        @endif

                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection
