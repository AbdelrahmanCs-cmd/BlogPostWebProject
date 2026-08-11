@extends('theme.master')
@section('content')
    {{-- <!-- Add new blog -->
    <a href="#" class="btn btn-sm btn-primary mr-2">Add New</a>
    <!-- End - Add new blog -->

    <ul class="nav navbar-nav navbar-right navbar-social">
        <a href="#" class="btn btn-sm btn-warning">Register / Login</a>

    </ul>

    <!--================Header Menu Area =================--> --}}

    <!--================ Hero sm banner start =================-->
    <section class="mb-5px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Login</h1>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm banner end =================-->

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="{{ route('login') }}" class="form-contact contact_form" method="post" id="contactForm"
                        novalidate="novalidate">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="email" id="email" type="email"
                                placeholder="Enter email address" value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div class="form-group">
                            <input class="form-control border" name="password" id="name" type="password"
                                placeholder="Enter your password" value="{{ old('password') }}">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />


                        <div class="form-group text-center text-md-right mt-3">
                            <a href="{{ route('register') }}" class="mx-3">Don't
                                have an account? Register</a>
                            <button type="submit" class="button button--active button-contactForm">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
