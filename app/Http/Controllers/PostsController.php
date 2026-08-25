<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'super_admin') {

            $posts = Blog::latest()->paginate(4);
        } else {

            $posts = Blog::where('user_id', $user->id)
                ->latest()
                ->paginate(4);
        }

        return view('theme.posts.posts', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('theme.posts.posts-create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Blog $post)
    {
        $user = auth()->user();

        if (!Auth::check()) {
            abort(404);
        }
        if ($user->role !== 'super_admin' && $post->user_id !== $user->id) {
            abort(404);
        }
        return view('theme.posts.posts-show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $post)
    {
        return view('theme.posts.posts-edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $post)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'required|string|max:255|unique:blogs,slug,' . $post->id,
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete('blogs/' . $post->image);
            }

            // Get uploaded image
            $image = $request->file('image');

            // Create unique image name
            $newImageName = time() . '-' . $image->getClientOriginalName();

            // Store image
            $image->storeAs(
                'blogs',
                $newImageName,
                'public'
            );

            // Store only the filename in database
            $validated['image'] = $newImageName;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Post
        |--------------------------------------------------------------------------
        */

        $post->update($validated);


        return redirect()
            ->route('posts.edit', $post->id)
            ->with('success', 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $post)
    {
        // Delete image
        if ($post->image) {
            Storage::disk('public')->delete('blogs/' . $post->image);
        }

        // Delete post
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
