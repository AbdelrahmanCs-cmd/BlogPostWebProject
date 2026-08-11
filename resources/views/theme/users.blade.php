@extends('theme.dashboard.partialDashboard.dashMaster')
@section('content')
    <div class="main-col-users">
        {{-- <header class="topbar" id="topbar"></header> --}}
        <main>
            <div class="alert alert-success" id="flashBox" hidden></div>

            <div class="toolbar">
                <!-- BLADE: <form method="GET"> so search/filter survive as query params -->
                <div class="toolbar-filters">
                    <div class="search-box">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                        <input type="search" placeholder="Search by name or email" value="">
                    </div>
                    <select class="filter-select">
                        <option value="">All roles</option>
                        <option>Super Admin</option>
                        <option>Editor</option>
                        <option>Author</option>
                    </select>
                    <select class="filter-select">
                        <option value="">All statuses</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
                {{-- BLADE: @can('create', App\Models\User::class) — only Super Admin per §3  --}}
                <a class="btn btn-primary" href="users-create.html" data-requires-role="super_admin">
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
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="post-title">{{ $user->name }}</div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge badge-role-super">{{ $user->role }}</span></td>
                                    <td><span class="badge badge-active">@php
                                        if ($user->is_active === 1) {
                                            echo 'Active';
                                        } else {
                                            echo 'Inactive';
                                        }
                                    @endphp</span></td>
                                    <td>Jan 12, 2025</td>
                                    <td>
                                        <div class="row-actions">
                                            <a class="icon-btn" href="users-show.html" title="View"
                                                data-requires-role="super_admin,editor"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg></a>
                                            <a class="icon-btn" href="users-edit.html" title="Edit"
                                                data-requires-role="super_admin"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
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
                                <tr>
                            @endforeach
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
                    <span>Showing 1–4 of 42 users</span>
                    <div class="pages">
                        <span class="is-current">1</span><a href="#">2</a><a href="#">3</a><a
                            href="#"></a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
