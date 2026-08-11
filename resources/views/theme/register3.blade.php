@extends('theme.master')


@section('content')
   

    <!--================ Hero sm banner start =================-->
    <section class="mb-5px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Register</h1>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm banner end =================-->

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @csrf
                    <form action="{{ route('register') }}" class="form-contact contact_form"
                         method="post" id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control border" name="name" id="name" type="text"
                                        placeholder="Enter your name" value="{{ old('name') }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control border" name="email" id="email" type="email"
                                        placeholder="Enter email address" value="{{ old('email') }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control border" name="password" id="password" type="password"
                                        placeholder="Enter your password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control border" name="password_confirmation" type="password"
                                        placeholder="Enter your password confirmation">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <a href="{{ route('login') }}" class="mx-3">Already
                                have an
                                account? Login</a>
                            <button type="submit" class="button button--active button-contactForm">Register</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
