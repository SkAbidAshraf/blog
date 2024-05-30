<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return view(
            'posts.index',
            [
                'tags' => Tag::
                whereHas('posts', function ($query) {
                    $query->published();
                })->take(15)->get()
            ]
        );
    }
    public function show(Post $post)
    {
        return view(
            'posts.show',
            [
                'post' => $post,
                'author' => User::where('id', $post->user_id)->first(),
                'latestPosts' => Post::published()->where('id', '!=', $post->id)->latest('published_at')->take(3)->get(),
                'tags' => Tag::whereHas('posts', function ($query) { $query->published();})->take(15)->get()
            ]
        );
    }

}
