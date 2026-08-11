<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class DashboardController extends Controller
{

    public function main()
    {
        $totalUsers = User::showAllUsers();
        $totalPosts = Blog::count();

        return view('theme.dashboard.main', compact(
            'totalUsers',
            'totalPosts'
        ));
    }
}
