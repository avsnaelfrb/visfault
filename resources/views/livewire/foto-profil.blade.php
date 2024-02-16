<div>
    <form wire:submit="simpanFotoProfil">
        <input type="file" wire:model="fotoProfil">
        @error('fotoProfil') <span>{{ $message }}</span> @enderror

        <button type="submit">Simpan Foto Profil</button>
    </form>
</div>
