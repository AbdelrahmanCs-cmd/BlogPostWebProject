@extends('theme.master')

@section('title', 'Category')

@section('categories-active', 'active')

@section('content')

    @include('theme.partialThemes.hero', ['title' => $categoryName])

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">

        <div class="container">

            <div class="row">

                <!-- Blog Posts -->
                <div class="col-lg-8">

                    <div class="row">

                        @if ($blogs->count() > 0)

                            @foreach ($blogs as $blog)
                                <div class="col-md-6 mb-4">

                                    <div class="single-recent-blog-post card-view">

                                        <!-- Image -->
                                        <div class="thumb">

                                            <img class="card-img rounded-0" src="{{ asset('storage/blogs/' . $blog->image) }}"
                                                alt="{{ $blog->name }}">

                                            <ul class="thumb-info">

                                                <li>
                                                    <a href="#">
                                                        <i class="ti-user"></i>
                                                        {{ $blog->user->name }}
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ti-themify-favicon"></i>
                                                        2 Comments
                                                    </a>
                                                </li>

                                            </ul>

                                        </div>

                                        <!-- Details -->
                                        <div class="details">

                                            <h3>
                                                {{ $blog->name }}
                                            </h3>

                                            <p>
                                                {{ $blog->description }}
                                            </p>

                                            <a class="button" href="{{ route('blogs.show', ['blog' => $blog]) }}">
                                                Read More
                                                <i class="ti-arrow-right"></i>
                                            </a>

                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p>No posts found in this category.</p>
                            </div>

                        @endif

                    </div>


                    <!-- Pagination -->
                    @if ($blogs->count() > 0)
                        <div class="row">

                            <div class="col-lg-12">

                                <div class="blog-pagination">
                                    {{ $blogs->render('pagination::bootstrap-4') }}
                                </div>

                            </div>

                        </div>
                    @endif

                </div>


                <!-- Sidebar -->
                @include('theme.partialThemes.sideBar')

            </div>

        </div>

    </section>
    <!--================ End Blog Post Area =================-->

@endsection
