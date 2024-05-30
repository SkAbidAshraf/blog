<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CommentedPosts extends Component
{
    public function render()
    {
        return view('livewire.commented-posts',[
            'posts' => Post::published()->latest('published_at')->get()
        ]);
    }
}
