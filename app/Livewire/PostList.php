<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User as Authenticatable;
use App\models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $author = '';

    #[Url()]
    public $search = '';

    #[Url()]
    public $tag = '';

    #[Url()]
    public $popular = false;
    public function getPopularPosts()
    {
        $this->popular = true;
        $this->resetPage();
    }

    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
        $this->popular = false;
        $this->resetPage();
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = preg_replace('/\s+/', ' ', trim($search));
    }

    public function clearTagSearch()
    {
        $this->search = '';
        $this->tag = '';
        $this->author = '';
        $this->resetPage();
    }

    #[Computed()]
    public function posts()
    {
        return Post::published()
            ->with('author')
            ->when($this->activeTag, function ($query) {
                $query->Tag($this->tag);
            })
            ->when($this->author, function ($query) {
                $query->where('user_id', $this->author);
            })
            ->when($this->popular, function ($query){
                $query->withCount('likes')->orderBy("likes_count", 'desc');
            })
            ->where('title', 'like', "%{$this->search}%")
            ->orderBy('published_at', $this->sort)
            ->paginate(10);  // simplePaginate()
    }

    #[Computed()]
    public function activeTag()
    {
        if($this->tag ===null || $this->tag==="") {
            return null;
        }
        return Tag::where('slug', $this->tag)->first();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
