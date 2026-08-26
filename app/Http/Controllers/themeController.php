<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class themeController extends Controller
{
    function master()
    {
        return view('theme.master');
    }
    function index()
    {
        // ensure required arguments are provided to avoid argument count errors
        $blogs = Blog::paginate(2);

        return view('theme.index', compact('blogs'));
    }
    function login()
    {
        return view('theme.login');
    }
    function register()
    {
        return view('theme.register');
    }
    function contact()
    {
        return view('theme.contact');
    }
    public function category(int $id)
    {
        // provide all expected arguments to paginate to satisfy static analysis
        $categoryName = Category::find($id)->name;
        $blogs = Blog::where('category_id', $id)->paginate(8);
        $categories = Category::withCount('blogs')->get();
        return view('theme.category', compact('blogs', 'categoryName', 'categories'));
    }
    function blogDetails()
    {
        return view('theme.blogDetails');
    }
}
