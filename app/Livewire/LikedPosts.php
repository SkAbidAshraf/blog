<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikedPosts extends Component
{
    public function render()
    {
        $userId = Auth::id();
        $posts = Post::liked($userId)->published()->latest('published_at')->paginate(10);

        return view('livewire.liked-posts', [
            'posts' => $posts
        ]);
    }
}
