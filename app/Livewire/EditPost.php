<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class EditPost extends Component
{
    use WithFileUploads;
    public $postId;
    public $title;
    public $deskripsi;
    public $oldImage;
    public $newImage;

    public function mount($postId)
    {
        $this->postId = $postId;
        $post = Post::findOrFail($postId);

        // Inisialisasi nilai pada form edit dengan data post yang ada
        $this->title = $post->title;
        $this->deskripsi = $post->deskripsi;
        $this->oldImage = $post->image;
    }

    public function updatePost()
    {
        // Validasi jika diperlukan
        $this->validate([
            'title' => 'nullable|max:50',
            'deskripsi' => 'nullable|max:100',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Simpan perubahan ke database
        $post = Post::findOrFail($this->postId);
        $post->update([
            'title' => $this->title,
            'deskripsi' => $this->deskripsi,
        ]);
        
        if ($this->newImage) {
            $newImagePath = $this->newImage->store('public/images');
            $post->update(['image' => str_replace('public/', '', $newImagePath)]);
        }
        // Redirect atau sesuaikan dengan kebutuhan
        return redirect()->route('post.detail', ['id' => $this->postId]);
    }

    public function render()
    {
        return view('livewire.edit-post')->title('VisFault');
    }
}
