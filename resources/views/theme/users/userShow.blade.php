@extends('theme.dashboard.partialDashboard.dashMaster')
@section('content')
    <div class="shell">

        <div class="main-col">

            <main>
                <a class="back-link" href="{{ route('users.index') }}">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to users
                </a>

                <div class="welcome-row">
                    <div>
                        <div class="welcome-heading">Marcus Reed</div>
                        <div class="welcome-date">marcus@example.com</div>
                    </div>
                    <div class="quick-actions">
                        <a class="btn btn-ghost" href="{{ route('users.edit', $user->id) }}"
                            data-requires-role="super_admin">Edit user</a>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="panel">
                        <div class="panel-head">
                            <div class="panel-title">Account details</div>
                        </div>
                        <div style="padding:20px 18px;">
                            <dl class="detail-grid">
                                <dt>Role</dt>
                                <dd><span class="badge badge-role-editor">Editor</span></dd>
                                <dt>Status</dt>
                                <dd><span class="badge badge-active">Active</span></dd>
                                <dt>Email</dt>
                                <dd>marcus@example.com</dd>
                                <dt>Joined</dt>
                                <dd>March 4, 2025</dd>
                                <dt>Last login</dt>
                                <dd>2 hours ago</dd>
                                <dt>Posts authored</dt>
                                <dd>23</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- BLADE: Post::where('user_id', $user->id)->latest()->take(5)->get() -->
                    <div class="panel">
                        <div class="panel-head">
                            <div class="panel-title">Posts by Marcus</div>
                            <a href="posts-index.html" class="panel-link">View all →</a>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="post-title">Rolling out the new onboarding flow</div>
                                    </td>
                                    <td><span class="badge badge-published">Published</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="post-title">Hiring: two open roles on platform</div>
                                    </td>
                                    <td><span class="badge badge-draft">Draft</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="post-title">How we run sprint retros</div>
                                    </td>
                                    <td><span class="badge badge-published">Published</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
