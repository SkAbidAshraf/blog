<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'featuredPosts' => Post::published()->featured()->latest('published_at')->take(4)->get(),
            'latestPosts' => Post::published()->latest('published_at')->take(9)->get()
        ]);
    }
    public function aboutUs()
    {
        return view('about-us');
    }
    public function policy()
    {
        return view('policy');
    }

    public function history()
    {
        return view('history.bookmarked-posts');
    }

    public function likedPosts()
    {
        return view('history.liked-posts');
    }

    public function commentedPosts()
    {
        return view('history.commented-posts');
    }

    public function bookmarkedPosts()
    {
        return view('history.bookmarked-posts');
    }

}
