<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    use WithFileUploads;

    public $totalLikes;
    public $postCount;
    public $user;
    public $posts;
    public $fotoProfil;
    
    public function  mount() {

        $this->user = Auth::user();
        $this->posts = Post::where('user_id', Auth::user()->id)->get();
        $this->postCount = $this->posts->count();
        $this->totalLikes = $this->calculateTotalLikes();
    }

    private function calculateTotalLikes()
    {
        return Like::whereIn('post_id', $this->posts->pluck('id'))->count();
    }

    public function render()
    {

        // Mengambil foto-foto yang terkait dengan pengguna yang login
        $user = Auth::user();
        $fotoProfilPath = asset('storage/foto-profil/' . ($user->foto_profil ?: 'default.png'));

        return view('livewire.profile', compact('fotoProfilPath'))->title('VisFault');
    }

}
