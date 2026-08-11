@php
    use App\Models\Category;
    $headerCategories = Category::take(4)->get();
@endphp
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">

                <!-- Logo -->
                <a class="navbar-brand logo_h" href="{{ route('theme.index') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">

                    <!-- Left Menu -->
                    <ul class="nav navbar-nav menu_nav justify-content-center">

                        <li class="nav-item @yield('Home-active')">
                            <a class="nav-link" href="{{ route('theme.index') }}">
                                Home
                            </a>
                        </li>

                        <li class="nav-item @yield('Categories-active') submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                @if (count($headerCategories) > 0)

                                    @foreach ($headerCategories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('theme.category', $category->id) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>

                        <li class="nav-item @yield('Contact-active')">
                            <a class="nav-link" href="{{ route('theme.contact') }}">
                                Contact
                            </a>
                        </li>

                    </ul>

                    <!-- Right Menu -->
                    <ul class="navbar-nav ml-auto align-items-center">

                        @auth

                            <!-- Add New -->
                            {{-- <li class="nav-item mr-2">
                                <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary">
                                    Add New
                                </a>
                            </li> --}}

                            <!-- User Dropdown -->
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        My Profile
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf

                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>

                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-sm btn-warning" style="margin-left: 10px">
                                    Register / Login
                                </a>
                            </li>

                        @endauth

                    </ul>
                    @if (Auth::check())
                        <!-- Add new blog -->
                        <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary mr-2">Add New</a>
                        <!-- End - Add new blog -->
                    @endif


                    {{-- <ul class="nav navbar-nav navbar-right navbar-social">
                        <a href="#" class="btn btn-sm btn-warning">Register / Login</a>

                    </ul> --}}

                    <!--================Header Menu Area =================-->

                </div>
            </div>
        </nav>
    </div>
</header>
