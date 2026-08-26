@php
    use App\Models\User;
@endphp
@extends('theme.dashboard.partialDashboard.dashMaster')
@section('content')
    <div class="shell">
        <div class="main-col">
            <main>
                <div class="alert alert-success" id="flashBox" hidden></div>

                <div class="welcome-row">
                    <div>
                        <div class="welcome-heading">My profile</div>
                    </div>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="form-card demo-form"
                    data-success-message="Profile updated." novalidate>
                    @csrf
                    @method('PATCH')

                    <div class="form-section-title">Account details</div>
                    <div class="form-grid">
                        <div class="field full">
                            <label for="name">Full name</label>
                            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field full">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section-title">Change password</div>
                    <p class="form-note">Leave blank to keep your current password.</p>

                    <div class="form-grid">
                        <div class="field full">
                            <label for="current_password">Current password</label>
                            <input type="password" id="current_password" name="current_password">

                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="new_password">New password</label>
                            <input type="password" id="new_password" name="new_password">

                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="new_password_confirmation">Confirm new password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="js/app.js"></script>
@endsection
