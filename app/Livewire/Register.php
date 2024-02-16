<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{   
    public $name;
    public $username;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.register')->title('VisFault | Register');
    }
    public function store()
    {

        $validateData = $this->validate([
            'name' => ['required', 'max:60'],
            'username' => ['required', 'min:5', 'max:30', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:4', 'max:40'],
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        session()->flash('success', 'Registration successful! Please login');

        return redirect('/login');
    }
}
