<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Livewire\SearchPosts;

class Home extends Component
{
    public $posts;
    public $searchQuery = '';

    public function mount()
    {
        $this->posts = Post::all();
    }
    public function render()
    {
        $searchResults = [];

        if ($this->searchQuery) {
            $searchComponent = app(SearchPosts::class);
            $searchComponent->query = $this->searchQuery;
            $searchResults = $searchComponent->render()->render();
        }

        return view('livewire.home', [
            'searchResults' => $searchResults,
        ])->title('VisFault | Explore');
    }
}
