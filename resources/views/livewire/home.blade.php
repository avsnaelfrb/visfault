<div>
    @livewire('sidebar')
    <div class="konten-home">
        <div class="postingan d-flex">
            <div class="kolom-post">
                @foreach($posts as $post)
                <div class="card-post" wire:key="{{ $post->id }}">
                    <a href="{{ route('post.detail', ['id' => $post->id]) }}" wire:navigate>
                        @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="postingan-img">
                        @endif
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>