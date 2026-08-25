<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Override;



class BlogController
{


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    #[Middleware('auth')]
    public function create()
    {
        // if (Auth::check()) {
        $categories = Category::get();
        return view('theme.blogs.create', compact('categories'));
        // } else {
        //     abort(403);
        // };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $image = $request->image;
        $newImageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('blogs', $newImageName, 'public');
        $data['image'] = $newImageName;
        $data['user_id'] = Auth::user()->id;
        $data['published_at'] = now();

        $blog = Blog::create($data);




        return back()->with('blogCreateStatus', 'Blog has been Created Successfully and waiting for Admin Confirmation!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog = Blog::findOrFail($blog->id);
        $user = auth()->user();


        return view('theme.posts.single-post-view', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
