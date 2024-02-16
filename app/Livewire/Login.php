<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username;
    public $email;
    public $password;
    
    public function render()
    {
        return view('livewire.login')->title('VisFault | Login');
    }

    public function authenticate()
    {
        $credentials = $this->validate([
            'username' => ['required', 'min:5'],
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->to('/home');
        }

        session()->flash('LoginError', 'Login failed');
    }
}
