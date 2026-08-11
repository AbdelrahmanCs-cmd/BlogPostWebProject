@extends('theme.dashboard.partialDashboard.dashMaster')

@section('content')
    <div class="auth-shell">

        <div class="auth-side">
            <div class="brand">
                <div class="brand-mark">L</div>
                <div>
                    <div class="brand-text" style="color:#fff;">LBAS</div>
                    <div class="brand-sub">Blog Admin</div>
                </div>
            </div>

        </div>

        <div class="auth-form-col">

            <div class="form-card">

                <h1>Create Account</h1>

                <p class="auth-subtitle">
                    Create your account to access the admin dashboard.
                </p>

                <form method="POST" action="{{ route('register') }}" class="demo-form" novalidate>
                    @csrf

                    <div class="field full">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name"
                            value="{{ old('name') }}" required>

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="field full">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="name@example.com"
                            value="{{ old('email') }}" required>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="field full">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Choose a username"
                            value="{{ old('username') }}" required>

                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div class="field full">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Create a password" required>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="field full">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm your password" required>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width:100%;justify-content:center;margin-top:10px;">
                        Create Account
                    </button>

                </form>

                <p class="auth-foot" style="margin-top:20px;">
                    Already have an account?
                    <a href="{{ route('login') }}" style="color:var(--accent);font-weight:600;">
                        Log in
                    </a>
                </p>

            </div>

        </div>

    </div>
@endsection
