@extends('theme.dashboard.partialDashboard.dashMaster')

@section('content')
    <div class="main-col-posts">

        <main>

            <div class="alert alert-success" id="flashBox" hidden></div>

            <div class="toolbar">

                <div class="toolbar-filters">

                    <div class="search-box">

                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">

                            <circle cx="11" cy="11" r="7" />

                            <path d="m21 21-4.3-4.3" />

                        </svg>

                        <input type="search" placeholder="Search by title">

                    </div>


                    <select class="filter-select">

                        <option value="">All statuses</option>

                        <option>Published</option>

                        <option>Draft</option>

                    </select>

                </div>


                <a class="btn btn-primary" href="{{ route('blogs.create') }}"
                    data-requires-role="super_admin,editor,author">

                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">

                        <path d="M12 5v14M5 12h14" />

                    </svg>

                    New post

                </a>

            </div>


            <div class="panel">

                <table>

                    <thead>

                        <tr>

                            <th>Title</th>

                            <th>Author</th>

                            <th>Status</th>

                            <th>Updated</th>

                            <th></th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($posts as $post)
                            <tr>

                                <td>

                                    <div class="post-title">
                                        {{ $post->title }}
                                    </div>

                                    <div class="post-meta">
                                        /blog/{{ $post->slug }}
                                    </div>

                                </td>


                                <td>
                                    {{ $post->user->name }}
                                </td>

                                <td>
                                    <span class="badge badge-{{ $post->status }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>


                                <td>
                                    {{ $post->updated_at->diffForHumans() }}
                                </td>


                                <td>

                                    <div class="row-actions">

                                        {{-- View --}}
                                        <a class="icon-btn" href="{{ route('posts.show', ['post' => $post->id]) }}"
                                            title="View">

                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">

                                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />

                                                <circle cx="12" cy="12" r="3" />

                                            </svg>

                                        </a>


                                        {{-- Edit --}}
                                        <a class="icon-btn" href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                            title="Edit">

                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">

                                                <path d="M12 20h9" />

                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />

                                            </svg>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this post?')"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="icon-btn danger" title="Delete post">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M3 6h18" />

                                                    <path
                                                        d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m2 0-1 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 6" />
                                                </svg>
                                            </button>
                                        </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>


                <div class="pagination">

                    <span>
                        Showing
                        {{ $posts->firstItem() ?? 0 }}
                        –
                        {{ $posts->lastItem() ?? 0 }}
                        of
                        {{ $posts->total() }}
                        posts
                    </span>

                    <div class="pages">

                        {{-- Previous --}}
                        @if ($posts->onFirstPage())
                            <span class="disabled">
                                ‹
                            </span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}">
                                ‹
                            </a>
                        @endif


                        {{-- Page Numbers --}}
                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                            @if ($page == $posts->currentPage())
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
                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}">
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
