@extends('theme.dashboard.partialDashboard.dashMaster')

@section('content')
    <div class="main-col-useredit">

        <main>

            {{-- Back --}}
            <a class="back-link" href="{{ route('users.index') }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>

                Back to users
            </a>


            {{-- Success Message --}}
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

                    Please fix the following errors before saving.

                </div>
            @endif


            {{-- Edit Form --}}
            <form class="form-card" action="{{ route('users.update', $user->id) }}" method="POST">

                @csrf
                @method('PUT')


                <div class="form-grid">


                    {{-- Name --}}
                    <div class="field full">

                        <label for="name">
                            Full name
                        </label>

                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

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

                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            required>

                        @error('email')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div class="field">

                        <label for="password">
                            New password
                        </label>

                        <input type="password" id="password" name="password"
                            placeholder="Leave blank to keep current password">

                        @error('password')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div class="field">

                        <label for="password_confirmation">
                            Confirm new password
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation">

                    </div>


                    {{-- Role --}}
                    <div class="field">

                        <label for="role">
                            Role
                        </label>

                        <select id="role" name="role" required>

                            <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>
                                Super Admin
                            </option>

                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
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

                            <option value="1" {{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

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
                        Save changes
                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-ghost">
                        Cancel
                    </a>

                </div>

            </form>


            {{-- Danger Zone --}}
            @if ($user->id !== auth()->id())
                <div class="danger-zone">

                    <div>

                        <h3>
                            Delete this account
                        </h3>

                        <p>
                            Removes {{ $user->name }} and unassigns their posts.
                            This cannot be undone.
                        </p>

                    </div>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Delete user
                        </button>

                    </form>

                </div>
            @endif

        </main>

    </div>
@endsection
