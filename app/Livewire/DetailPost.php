<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Models\CommentReply;
use Illuminate\Support\Facades\Auth;

class DetailPost extends Component
{
    public $komen;
    public $replay_komen;
    public $replyingTo;

    protected $rules = [
        'komen' => 'required|max:255',
    ];
    public $post;
    public $likeCount;
    public $user;
    public $fotoProfil;
    public $showKomen = false;

    public function mount($id)
    {
        $this->post = Post::find($id);

        $this->likeCount = $this->post->likes()->count();
        
    }

    public function likePost()
    {
        $user = Auth::user();
            // Pengguna belum menyukai post, lakukan like
            if ($user->likes->contains('post_id', $this->post->id)) {
                // Pengguna sudah menyukai post, lakukan unlike
                $user->likes()->where('post_id', $this->post->id)->delete();
            } else {
                // Pengguna belum menyukai post, lakukan like
                $user->likes()->create(['post_id' => $this->post->id]);
            }
        
            // Pengguna sudah menyukai post, lakukan unlike
        
        $this->likeCount = $this->post->likes()->count();
        $this->post->refresh();
        
    }

    public function unlikePost() 
    {
        $user = Auth::user();
        
        if ($user->likes->contains('post_id', $this->post->id)) {
            // Pengguna sudah menyukai post, lakukan unlike
            $user->likes()->where('post_id', $this->post->id)->delete();
        }
                // Pengguna sudah menyukai post, lakukan unlike
        $this->likeCount = $this->post->likes()->count();
        $this->post->refresh();

    }

    public function addComment()
    {
        $this->validate();

        $this->komen = $this->komen ?: null;
        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'komen' => $this->komen,
        ]);

        $this->komen = ''; // Reset input setelah komentar ditambahkan
    }
    public function addReply($commentId)
    {
        $this->validate([
            'replay_komen' => 'required|max:255',
        ]);

        $this->replay_komen = $this->replay_komen ?: null;
        CommentReply::create([
            'comment_id' => $commentId,
            'user_id' => auth()->id(),
            'replay_komen' => $this->replay_komen,
        ]);

        $this->replay_komen = ''; // Reset input setelah balasan ditambahkan
        $this->replyingTo = null; // Reset status reply
    }

    public function startReply($commentId)
    {
        $this->replyingTo = $commentId;
    }

    public function cancelReply()
    {
        $this->replay_komen = '';
        $this->replyingTo = null;
    }

    public function render()
    {
        $user = Auth::user();
        $fotoProfilPath = asset('storage/foto-profil/' . ($this->post->user->foto_profil ?: 'default.png'));

        $comments = Comment::where('post_id', $this->post->id)
            ->with('user', 'replies.user')  // Pastikan relasi 'replies' sudah ada di model Comment
            ->get();
        return view('livewire.detail-post', ['comments' => $comments], compact('fotoProfilPath'))->title('VisFault');
    }
    
}

// Periksa apakah pengguna sudah menyukai post
        // if ($user->likes->contains('post_id', $this->post->id)) {
        //     // Pengguna sudah menyukai post, lakukan unlike
        //     $user->likes()->where('post_id', $this->post->id)->delete();
        // } else {
        //     // Pengguna belum menyukai post, lakukan like
        //     $user->likes()->create(['post_id' => $this->post->id]);
        // }

        // $this->likeCount = $this->post->likes()->count();
        //  // Perbarui data post