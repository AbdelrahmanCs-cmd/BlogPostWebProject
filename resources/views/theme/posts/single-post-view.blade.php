@include('theme.dashboard.partialDashboard.head')

<nav class="public-nav">
    <div class="brand">
        <div class="brand-mark">L</div>

        <div>
            <div class="brand-text">LBAS</div>
        </div>
    </div>
    @guest


        <a class="btn btn-ghost btn-sm" href="{{ route('login') }}">
            Log in
        </a>
    @endguest
</nav>


<main class="public-main">

    <a class="back-link" href="{{ route('posts.show', ['post' => $blog->id]) }}">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>

        Back to blog
    </a>


    <div class="public-post-head">

        <div class="post-meta">
            {{ $blog->user->name ?? 'Unknown Author' }}
            ·
            {{ $blog->created_at->format('M d, Y') }}
        </div>

        <h1>
            {{ $blog->title }}
        </h1>

    </div>


    {{-- Blog Image --}}
    @if ($blog->image)
        <div class="post-image">
            <img src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->title }}">
        </div>
    @endif


    {{-- Blog Content --}}
    <div class="content-preview">

        {!! nl2br(e($blog->content)) !!}

    </div>

</main>
