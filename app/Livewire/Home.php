<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    public $amount = 8;
    public $allPostsLoaded = false;

    public function loadMore()
    {
        $this->amount += 8;
        $totalPostsCount = Post::published()->count();

        if ($this->amount >= $totalPostsCount) {
            $this->allPostsLoaded = true;
        }
    }

    public function render()
    {
        return view('livewire.home',[
            'posts' => Post::published()->latest('published_at')->take($this->amount)->get()
        ]);
    }
}
