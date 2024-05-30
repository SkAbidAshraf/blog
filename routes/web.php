<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');

Route::get('/policy', [HomeController::class, 'policy'])->name('policy');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Route::get('/dashboard', function () {  return view('dashboard'); })->name('dashboard');

    Route::get('/history', [HomeController::class, 'history'])->name('history');

    Route::get('/history/liked-posts', [HomeController::class, 'likedPosts'])->name('history.liked-posts');

    // Route::get('/history/commented-posts', [HomeController::class, 'commentedPosts'])->name('history.commented-posts');

    Route::get('/history/bookmarked-posts', [HomeController::class, 'bookmarkedPosts'])->name('history.bookmarked-posts');
});
