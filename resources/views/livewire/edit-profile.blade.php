<div>
    <div>
        @livewire('sidebar')
    </div>
    <div class="konten-profile-edit">
        <div class="d-flex ms-5 mt-5">
            <div class="mb-3 me-5">
                <div class="ms-3">
                    <div>
                        @if ($newProfilePicture)
                        <img src="{{ $newProfilePicture->temporaryUrl() }}" alt="Preview Foto Profil"
                            class="img-preview">
                        @elseif ($existingProfilePicture)
                        <img src="{{ asset('storage/foto-profil/' . $existingProfilePicture) }}"
                            alt="Foto Profil Saat Ini" class="img-preview">
                        @endif
                        @error('newProfilePicture') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="ms-3">
                    <label for="newProfilePicture" class="form-label label-ganti-profile">Foto Profil Baru</label>
                    <input type="file" class="ganti-foto-profile" id="newProfilePicture" wire:model="newProfilePicture">
                    @error('newProfilePicture') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="ms-5 w-50">
                <form wire:submit="editProfile">
                    <div class="mb-3">
                        <div>
                            <label for="newUsername" class="label-edit">Username</label>
                        </div>
                        <div>
                            <input type="text" class="P-form" id="newUsername" wire:model="newUsername">
                            @error('newUsername') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div>
                            <label for="newName" class="label-edit">Nama</label>
                        </div>
                        <div>
                            <input type="text" class="P-form" id="newName" wire:model="newName">
                            @error('newName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div>
                            <label for="newBio" class="label-edit">Bio</label>
                        </div>
                        <div>
                            <textarea class="P-form" id="newBio" rows="3" wire:model="newBio"></textarea>
                            @error('newBio') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!-- Tampilkan foto profil yang sudah ada -->

                    <button type="submit" class="btn btn-primary simpan-edit-profile">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@livewireScripts
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('fileUpload', () => {
            let inputField = document.getElementById('newProfilePicture');
            let previewImage = document.querySelector('.img-preview');

            inputField.addEventListener('change', function () {
                let reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            });
        });
    });
</script>