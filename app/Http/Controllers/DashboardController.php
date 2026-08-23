<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class DashboardController extends Controller
{

    public function main()
    {
        if (!auth()->user()->can('view', User::class)) {
            return view('theme.dashboard.profile', [
                'user' => auth()->user(),
            ]);
        } else {
            $totalUsers = User::showAllUsers();
            $totalPosts = Blog::count();
            $latestPosts = Blog::latest()
                ->take(4)
                ->get();

            return view('theme.dashboard.main', compact(
                'totalUsers',
                'totalPosts',
                'latestPosts'
            ));
        }
       
    }
}
