<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DetailPostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('detail-post', [
            'title' => 'Detail Post',
            'post' => $post,
        ]);
    }
}
