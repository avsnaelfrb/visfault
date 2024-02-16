<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function logout() {

        Auth::logout();
        return  redirect('/login');
    }
    public function render()
    {
        $user = Auth::user();
        $fotoProfilPath = asset('storage/foto-profil/' . ($user->foto_profil ?: 'default.png'));
        return view('livewire.sidebar',compact('fotoProfilPath'));
    }


}
