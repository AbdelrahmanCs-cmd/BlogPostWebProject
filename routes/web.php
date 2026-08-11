<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\themeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
// THEME ROUTES
Route::controller(themeController::class)->name('theme.')->group(function () {
    Route::get('/master', 'master')->name('master');
    Route::get('/index', 'index')->name('index');
    // Route::get('/login', 'login')->name('login');
    // Route::get('/register', 'register')->name('register');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/category/{id}', 'category')->name('category');
    Route::get('/blogDetails', 'blogDetails')->name('blogDetails');
});

//SUBSCRIBER ROUTES
Route::post('/subscriber.store', [SubscriberController::class, 'store'])->name('subscriber.store');

//CONTACT ROUTES
Route::post('/contact.store', [ContactController::class, 'store'])->name('contact.store');

//BLOG CONTROLLER
Route::resource('blogs', BlogController::class);
// Route::get('/main', function () {
//     return view('theme.dashboard.partialDashboard.main');
// })->name('main');

// users controller
Route::resource('users', UserController::class);

// BREEZE ROUTES
Route::get('/', [DashboardController::class, 'main'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
