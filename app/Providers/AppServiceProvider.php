<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Blog;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // View::share('totalUsers', User::count());
        View::share('draftPosts', Blog::where('status', 'draft')->count());
        View::share('publishedPosts', Blog::where('status', 'published')->count());
    }
}
