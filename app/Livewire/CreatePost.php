<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $deskripsi;
    public $image;
    public $title;

    public function render()
    {
        return view('livewire.create-post')->title('VisFault | Create-Post');
    }

    public function store()
    {
        $this->validate([
            'title' => 'max:50',
            'deskripsi' => 'max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

    
        $imagePath = $this->image->store('images', 'public');

        
        $post = Post::create([
            'title' => $this->title,
            'deskripsi' => $this->deskripsi,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

    
        $this->title = '';
        $this->deskripsi = '';
        $this->image = null; 

        session()->flash('message', 'Image uploaded successfully!');

        return redirect()->back();
    }

    
}
