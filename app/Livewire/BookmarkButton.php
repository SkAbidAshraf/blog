<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BookmarkButton extends Component
{
    public Post $post;

    public function toggleBookmark()
    {
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);
        }

        $user = auth()->user();

        if ($user->hasBookmarked($this->post)) {
            $user->bookmarks()->detach($this->post);
            return;
        }

        $user->bookmarks()->attach($this->post);
    }

    public function render()
    {
        return view('livewire.bookmark-button');
    }
}
