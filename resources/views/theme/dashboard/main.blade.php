@can('view', App\Models\User::class)


    @extends('theme.dashboard.partialDashboard.dashMaster')
    @section('content')

        <body data-active-nav="dashboard" data-page-eyebrow="Overview" data-page-title="Welcome back, Sara">
            <div class="shell">
                <div class="main-col">
                    <main>
                        <div class="alert alert-success" id="flashBox" hidden></div>

                        <div class="welcome-row">
                            <div>
                                <div class="welcome-heading">Dashboard</div>
                                <div class="welcome-date" id="todayDate">{{ date('F j, Y') }}</div>
                            </div>
                            <div class="quick-actions">
                                {{-- <!-- BLADE: @can('create', App\Models\Post::class) --> --}}
                                <a class="btn btn-primary" href="{{ route('blogs.create') }}"
                                    data-requires-role="super_admin,editor,author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M12 5v14M5 12h14" />
                                    </svg>
                                    New post
                                </a>
                                @can('create', App\Models\User::class)
                                    <a class="btn btn-ghost" href="{{ route('users.create') }}" data-requires-role="super_admin">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M20 8v6M23 11h-6" />
                                        </svg>
                                        New user
                                    </a>
                                @endcan
                            </div>
                        </div>


                        <!-- BLADE: values from $totalUsers / $totalPosts / $draftCount / $publishedCount -->
                        <div class="stat-grid">
                            <div class="stat-card c-users" data-requires-role="super_admin,editor">
                                <div class="stamp">Users</div>
                                <div class="stat-label">Total users</div>
                                <div class="stat-value">{{ $totalUsers }}</div>
                                <div class="stat-foot">3 added this week</div>
                            </div>
                            <div class="stat-card c-total">
                                <div class="stamp">Posts</div>
                                <div class="stat-label">Total posts</div>
                                <div class="stat-value">{{ $totalPosts }}</div>
                                <div class="stat-foot">Across all authors</div>
                            </div>
                            <div class="stat-card c-draft">
                                <div class="stamp">Draft</div>
                                <div class="stat-label">Drafts</div>
                                <div class="stat-value">{{ $draftPosts }}</div>
                                <div class="stat-foot">Awaiting publish</div>
                            </div>
                            <div class="stat-card c-pub">
                                <div class="stamp">Live</div>
                                <div class="stat-label">Published</div>
                                <div class="stat-value">{{ $publishedPosts }}</div>
                                <div class="stat-foot">Visible on public blog</div>
                            </div>
                        </div>

                        <div class="grid-2">
                            {{-- <!-- BLADE: @foreach ($recentPosts as $post) --> --}}
                            <div class="panel">
                                <div class="panel-head">
                                    <div class="panel-title">Recent posts</div>
                                    <a href="posts-index.html" class="panel-link">View all →</a>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($latestPosts as $post)
                                            <tr>

                                                {{-- Post title + slug --}}
                                                <td>

                                                    <div class="post-title">
                                                        {{ $post->title }}
                                                    </div>

                                                    <div class="post-meta">
                                                        /blog/{{ $post->slug }}
                                                    </div>

                                                </td>


                                                {{-- Author --}}
                                                <td>
                                                    {{ $post->user->name ?? 'Unknown' }}
                                                </td>


                                                {{-- Status --}}
                                                <td>

                                                    @if ($post->status === 'published')
                                                        <span class="badge badge-published">
                                                            Published
                                                        </span>
                                                    @else
                                                        <span class="badge badge-draft">
                                                            Draft
                                                        </span>
                                                    @endif

                                                </td>


                                                {{-- Created date --}}
                                                <td>
                                                    {{ $post->created_at->diffForHumans() }}
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="4" style="text-align: center;">
                                                    No posts found.
                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>

                            <div style="display:flex;flex-direction:column;gap:16px;">
                                {{-- <!-- BLADE: @can('viewAny', App\Models\User::class) --> --}}
                                <div class="panel" data-requires-role="super_admin,editor">
                                    <div class="panel-head">
                                        <div class="panel-title">Team</div>
                                        <a href="users-index.html" class="panel-link">Manage →</a>
                                    </div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="post-title">Sara Malik</div>
                                                    <div class="post-meta">sara@example.com</div>
                                                </td>
                                                <td><span class="badge badge-role-super">Super admin</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="post-title">Marcus Reed</div>
                                                    <div class="post-meta">marcus@example.com</div>
                                                </td>
                                                <td><span class="badge badge-role-editor">Editor</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="post-title">Priya Nair</div>
                                                    <div class="post-meta">priya@example.com</div>
                                                </td>
                                                <td><span class="badge badge-role-author">Author</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="panel">
                                    <div class="panel-head">
                                        <div class="panel-title">Recent activity</div>
                                    </div>
                                    <ul class="activity-list">
                                        <li class="activity-item">
                                            <div class="activity-dot"></div>
                                            <div>
                                                <div class="activity-text"><b>Marcus Reed</b> published "Rolling out the new
                                                    onboarding flow"</div>
                                                <div class="activity-time">2 hours ago</div>
                                            </div>
                                        </li>
                                        <li class="activity-item">
                                            <div class="activity-dot"></div>
                                            <div>
                                                <div class="activity-text"><b>Sara Malik</b> saved a draft "Q3 roadmap"</div>
                                                <div class="activity-time">Yesterday, 4:12 PM</div>
                                            </div>
                                        </li>
                                        <li class="activity-item">
                                            <div class="activity-dot"></div>
                                            <div>
                                                <div class="activity-text"><b>Sara Malik</b> deactivated user
                                                    "j.trent@example.com"
                                                </div>
                                                <div class="activity-time">Yesterday, 11:03 AM</div>
                                            </div>
                                        </li>
                                        <li class="activity-item">
                                            <div class="activity-dot"></div>
                                            <div>
                                                <div class="activity-text"><b>Priya Nair</b> logged in</div>
                                                <div class="activity-time">3 days ago</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </body>
    @endsection
@endcan
