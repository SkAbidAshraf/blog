<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookmarkedPosts extends Component
{
    public function render()
    {
        $userId = Auth::id();
        $posts = Post::bookmarked($userId)->published()->latest('published_at')->paginate(10);

        return view('livewire.bookmarked-posts', [
            'posts' => $posts
        ]);
    }
}
