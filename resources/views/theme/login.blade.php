@extends('theme.dashboard.partialDashboard.dashMaster')
@section('content')

    <body>
        <div class="auth-shell">
            <div class="auth-side">
                <div class="brand">
                    <div class="brand-mark">L</div>
                    <div>
                        <div class="brand-text" style="color:#fff;">LBAS</div>
                        <div class="brand-sub">Blog Admin</div>
                    </div>
                </div>
                {{-- <blockquote>
                    "Different users must have different permissions — a Super Admin can manage
                    everything, an Editor can manage content, an Author manages their own posts."
                    <cite>— internal portal brief</cite>
                </blockquote> --}}
            </div>

            <div class="auth-form-col">
                <div class="auth-card">
                    <h1>Welcome back</h1>
                    <p class="sub">Log in to manage users and blog posts.</p>

                    <!-- BLADE: <form method="POST" action=" route('login') "> csrf -->
                    <form method="POST" action="{{ route('login') }}" class="demo-form"
                        data-success-message="Signed in — redirecting to dashboard." novalidate>
                        @csrf

                        {{-- Email field --}}
                        <div class="field full" style="margin-bottom:14px;">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" placeholder="name@example.com"
                                value="{{ old('email') }}" required>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        {{-- Password field --}}

                        <div class="field full" style="margin-bottom:8px;">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />


                        <div class="auth-links" style="margin-bottom:20px;">
                            <label class="checkbox-row"><input type="checkbox" name="remember"> Remember me</label>
                            <a href="password-reset.html" style="color:var(--accent);">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">Log
                            in</button>
                    </form>

                    <div style="margin-top:16px; text-align:center;">
                        <span>Don't have an account?</span>
                        <a href="{{ route('register') }}"
                            style="color:var(--accent); font-weight:600; text-decoration:none;">
                            Create one
                        </a>
                    </div>


                </div>
            </div>
    </body>
@endsection
