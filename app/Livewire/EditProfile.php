<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class EditProfile extends Component
{
    use WithFileUploads;
    public $newUsername;
    public $newName;
    public $newBio;
    public $newProfilePicture;
    public $existingProfilePicture;
    public $fotoProfil;

    public function mount()
{
    $user = Auth::user();

    $this->newUsername = $user->username;
    $this->newName = $user->name;
    $this->newBio = $user->bio;
    // Tambahkan properti untuk menyimpan foto profil yang sudah ada
    $this->existingProfilePicture = $user->foto_profil;
}
    public function editProfile()
    {
        $this->validate([
            'newUsername' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'newName' => 'required|string|max:255',
            'newBio' => 'nullable|string|max:255',
            'newProfilePicture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        $user->update([
            'username' => $this->newUsername,
            'name' => $this->newName,
            'bio' => $this->newBio,
        ]);

        if ($this->newProfilePicture) {
            // Hapus foto profil lama jika bukan default.jpg
            if ($user->foto_profil && $user->foto_profil !== '') {
                Storage::delete('public/foto-profil/' . $user->foto_profil);
            }

            // Simpan foto baru ke penyimpanan
            $path = $this->newProfilePicture->storeAs('public/foto-profil', $user->id . '.' . $this->newProfilePicture->getClientOriginalExtension());
            $user->update(['foto_profil' => basename($path)]);
        }

        $this->reset([
            'newUsername',
            'newName',
            'newBio',
            'newProfilePicture',
        ]);

        return redirect()->route('profile.show', ['username' => auth()->user()->username]);
        // $this->emit('profileUpdated', 'Profil berhasil diperbarui.');
    }
    public function render()
    {
        return view('livewire.edit-profile')->title('VisFault');
    }
}
