@extends('theme.dashboard.partialDashboard.dashMaster')

@section('content')

    <div class="main-col-post-edit">

        <main>

            <a class="back-link" href="{{ route('posts.index') }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to posts
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
                    <div>
                        <strong>Please fix the following errors:</strong>

                        <ul style="margin: 6px 0 0 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif


            {{-- Edit Form --}}
            <form class="form-card" action="{{ route('posts.update', $post->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- Title --}}
                    <div class="field full">
                        <label for="postTitle">Title</label>

                        <input type="text" id="postTitle" name="title" value="{{ old('title', $post->title) }}"
                            required>

                        @error('title')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Slug --}}
                    <div class="field full">
                        <label for="postSlug">Slug</label>

                        <input type="text" id="postSlug" name="slug" value="{{ old('slug', $post->slug) }}">

                        <span class="hint">
                            Changing this changes the post's public URL.
                        </span>

                        @error('slug')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Content --}}
                    <div class="field full">
                        <label for="content">Content</label>

                        <textarea id="content" name="content" rows="10">{{ old('content', $post->content) }}</textarea>

                        @error('content')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Image --}}
                    <div class="field full">

                        <label for="image">Blog Image</label>

                        @if ($post->image)
                            <div style="margin-bottom: 10px;">

                                <img src="{{ asset('storage/blogs/' . $post->image) }}" alt="{{ $post->title }}"
                                    style="
                                        max-width: 200px;
                                        max-height: 120px;
                                        object-fit: cover;
                                        border: 1px solid var(--line);
                                    ">

                            </div>
                        @endif


                        <input type="file" id="image" name="image" accept="image/*">

                        <span class="hint">
                            Leave empty if you don't want to change the current image.
                        </span>

                        @error('image')
                            <span class="field-error">{{ $message }}</span>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="field">

                        <label for="postStatus">Status</label>

                        <select id="postStatus" name="status">

                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                        </select>

                        @error('status')
                            <span class="field-error">{{ $message }}</span>
                        @enderror

                    </div>

                </div>


                {{-- Form Actions --}}
                <div class="form-actions">

                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>

                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-ghost">
                        Cancel
                    </a>

                </div>

            </form>


            {{-- Delete --}}
            <div class="danger-zone">

                <div>
                    <h3>Delete this post</h3>

                    <p>
                        This removes it permanently, including from the public blog.
                    </p>
                </div>


                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this post?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Delete post
                    </button>

                </form>

            </div>

        </main>

    </div>

@endsection
