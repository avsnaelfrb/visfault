<div>
    @livewire('sidebar')
    <div class="konten-edit-post">
        <form wire:submit="updatePost">
            <div class="d-flex mt-3">

                <div>
                    <div class="box-preview">
                        @if($newImage)
                        <img src="{{$newImage->temporaryUrl()}}" alt="" class="image-preview">
                        @elseif($oldImage)
                        <img src="{{ asset('storage/' . $oldImage) }}" alt="Old Image" class="image-preview">
                        @endif
                    </div>
                    <div>
                        <label for="newImage" wire:model="newImage"
                            class="drag-image d-flex flex-align-center justify-content-center">
                            <div class="drag-text">
                                Upload Gambar
                            </div>
                        </label>
                        <input type="file" wire:model="newImage" id="newImage" class="newImage d-none">
                    </div>
                </div>

                <div class="form-create">
                    <div>
                        <input type="text" wire:model="title" class="c-post" placeholder="Title post">
                    </div>

                    <div>
                        <textarea wire:model="deskripsi" class="c-post-desk" placeholder="Deskripsi"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn create-btn">Update Post</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>