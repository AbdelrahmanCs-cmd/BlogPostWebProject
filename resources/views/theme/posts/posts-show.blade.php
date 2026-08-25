@extends('theme.dashboard.partialDashboard.dashMaster')

@section('content')
    <div class="main-col-posts">



        <main>

            <a class="back-link" href="{{ route('posts.index') }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>

                Back to posts
            </a>


            <div class="welcome-row">

                <div>

                    <div class="welcome-heading">
                        {{ $post->title }}
                    </div>

                    <div class="welcome-date">
                        /blog/{{ $post->slug }}
                    </div>

                </div>

                <div class="quick-actions">

                    <a class="btn btn-ghost" href="{{ route('blogs.show', ['blog' => $post->id]) }}">
                        View live
                    </a>

                    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                        Edit post
                    </a>

                </div>

            </div>


            <div class="grid-2">

                {{-- Content --}}
                <div class="panel">

                    <div class="panel-head">
                        <div class="panel-title">
                            Content
                        </div>
                    </div>

                    <div style="padding:20px 18px;">

                        <p class="content-preview">
                            {{ $post->content }}
                        </p>

                    </div>

                </div>


                {{-- Details --}}
                <div class="panel">

                    <div class="panel-head">
                        <div class="panel-title">
                            Details
                        </div>
                    </div>

                    <div style="padding:20px 18px;">

                        <dl class="detail-grid">

                            <dt>Author</dt>
                            <dd>
                                {{ $post->user->name ?? 'Unknown' }}
                            </dd>


                            <dt>Status</dt>
                            <dd>
                                <span class="badge badge-published">
                                    Published
                                </span>
                            </dd>


                            <dt>Published</dt>
                            <dd>
                                {{ $post->created_at->format('M d, Y, g:i A') }}
                            </dd>


                            <dt>Last updated</dt>
                            <dd>
                                {{ $post->updated_at->diffForHumans() }}
                            </dd>

                        </dl>

                    </div>

                </div>

            </div>

        </main>

    </div>
@endsection
