<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;

    #[Rule('required|min:1|max:300')]
    public string $comment;

    public function postComment()
    {
        if (auth()->guest()) {
            return;
        }
        $this->validateOnly('comment');

        $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id(),
        ]);

        $this->reset('comment');
    }

    #[Computed()]
    public function comments()
    {
        return $this?->post?->comments()->latest()->paginate(5);
    }

    public function deleteComment(Comment $comment)
    {
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);
        }
        $comment->delete();
        return view('livewire.post-comments');
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
