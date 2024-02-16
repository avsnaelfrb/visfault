<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchPosts extends Component
{
    public $query;

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->query . '%')->get();

        return view('livewire.search-posts', ['posts' => $posts]);
    }
}
