<?php

use App\Livewire\Home;
use Livewire\Livewire;
use App\Livewire\Login;
use App\Livewire\Profile;
use App\Livewire\Sidebar;
use App\Livewire\EditPost;
use App\Livewire\Register;
use App\Livewire\CreatePost;
use App\Livewire\DetailPost;
use App\Livewire\EditProfile;
use Illuminate\Support\Facades\Route;



Route::get('/login', Login::class)->name('login');
Route::get('/', Login::class)->name('login');

Route::get('/register', Register::class)->name('register');

Route::get('/home', Home::class)->name('home');

Route::get('/create-post', CreatePost::class)->name('create-new-post');

Route::get('/post/{id}', DetailPost::class)->name('post.detail');

Route::get('/edit-post/{postId}', EditPost::class)->name('edit-post');

Route::get('/profile/{username}', Profile::class)->name('profile.show');

Route::get('/profile/edit-profile/{username}', EditProfile::class)->name('edit-profile');

Livewire::component('sidebar', Sidebar::class);
