@extends('theme.dashboard.partialDashboard.dashMaster')

@section('content')
    <div class="main-col">

        <main>

            {{-- Back --}}
            <a class="back-link" href="{{ route('users.index') }}">

                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="M19 12H5M12 19l-7-7 7-7" />

                </svg>

                Back to users

            </a>


            {{-- Success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-error">

                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">

                        <circle cx="12" cy="12" r="10" />

                        <path d="M12 8v5M12 16h.01" />

                    </svg>

                    Please fix the errors below before creating the user.

                </div>
            @endif


            {{-- Create User Form --}}
            <form class="form-card" action="{{ route('users.store') }}" method="POST">

                @csrf


                <div class="form-grid">


                    {{-- Name --}}
                    <div class="field full">

                        <label for="name">
                            Full name
                        </label>

                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="e.g. Priya Nair" required>

                        <span class="hint">
                            2–100 characters
                        </span>

                        @error('name')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="field full">

                        <label for="email">
                            Email address
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="name@example.com" required>

                        <span class="hint">
                            Must be unique across all accounts
                        </span>

                        @error('email')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div class="field">

                        <label for="password">
                            Password
                        </label>

                        <input type="password" id="password" name="password" required>

                        @error('password')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Password Confirmation --}}
                    <div class="field">

                        <label for="password_confirmation">
                            Confirm password
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation" required>

                    </div>


                    {{-- Role --}}
                    <div class="field">

                        <label for="role">
                            Role
                        </label>

                        <select id="role" name="role" required>

                            <option value="">
                                Select a role
                            </option>

                            <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>
                                Super Admin
                            </option>

                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>
                                User
                            </option>

                        </select>

                        @error('role')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="field">

                        <label for="status">
                            Status
                        </label>

                        <select id="status" name="status">

                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        <span class="hint">
                            Inactive users cannot log in
                        </span>

                        @error('status')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                </div>


                {{-- Actions --}}
                <div class="form-actions">

                    <button type="submit" class="btn btn-primary">
                        Create user
                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-ghost">
                        Cancel
                    </a>

                </div>

            </form>

        </main>

    </div>
@endsection
