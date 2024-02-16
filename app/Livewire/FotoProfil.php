<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FotoProfil extends Component
{
    use WithFileUploads;

    public $fotoProfil;

    public function render()
    {
        $user = Auth::user();
        $fotoProfilPath = asset('storage/foto-profil/' . ($user->foto_profil ?: 'default.png'));

        return view('livewire.foto-profil', compact('fotoProfilPath'));
    }

    public function simpanFotoProfil()
    {
        $this->validate([
            'fotoProfil' => 'image|mimes:jpg,jpeg,png|max:2048', // Sesuaikan dengan kebutuhan
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->foto_profil && $user->foto_profil !== 'default.jpg') {
            Storage::delete('public/foto-profil/' . $user->foto_profil);
        }

        // Simpan foto baru ke penyimpanan
        $path = $this->fotoProfil->storeAs('public/foto-profil', $user->id . '.' . $this->fotoProfil->getClientOriginalExtension());

        // Update kolom foto_profil pada tabel users
        $user->update(['foto_profil' => basename($path)]);

        session()->flash('success', 'Foto profil berhasil diubah.');
    }
}
