<div>
    @livewire('sidebar')
    <div class="konten-create">
        <form wire:submit="store">
            <div class="d-flex mt-3">

                <div class="ms-5">
                    <div class="box-preview">
                        @if ($image)
                        <img class="image-preview" src="{{ $image->temporaryUrl() }}" alt="../icon/image.png">
                        @endif
                    </div>
                    <label for="image" class="drag-image d-flex flex-align-center justify-content-center"
                        wire:model="image">
                        <div class="drag-text">
                            Choose image, click here
                        </div>
                    </label>
                    <input type="file" wire:model="image" accept="image/*" id="image" class="image">
                    @error('image') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-create">
                    <div>
                        <input type="text" wire:model="title" class="c-post" placeholder="Title post">
                        @error('title')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <textarea wire:model="deskripsi" class="c-post-desk" placeholder="Deskripsi"></textarea>
                        @error('deskripsi')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn create-btn">Upload Image</button>
                    </div>
                    <div wire:loading class="loading-post">
                        Upload image...
                    </div>
                </div>
                
            </div>
        </form>
    </div>

    @if(session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif


</div>

{{-- <script>
    const dropArea = document.querySelector('.drag-image');
    const input = document.querySelector('#image');
    const previewImage = document.querySelector('.image-preview');

    dropArea.addEventListener('dragover', (event) => {
        event.stopPropagation();
        event.preventDefault();
        dropArea.classList.add('drag-over');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('drag-over');
    });

    dropArea.addEventListener('drop', (event) => {
        event.stopPropagation();
        event.preventDefault();
        dropArea.classList.remove('drag-over');
        input.files = event.dataTransfer.files;
        previewImage.src = URL.createObjectURL(event.dataTransfer.files[0]);
    });

    input.addEventListener('change', () => {
        if (input.files.length > 0) {
            previewImage.src = URL.createObjectURL(input.files[0]);
        }
    });
</script> --}}
{{-- <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-image"
    viewBox="0 0 16 16">
    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
    <path
        d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
</svg> --}}