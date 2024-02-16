<div>
    <div>
        @livewire('sidebar')
    </div>
    <div class="konten-profile d-flex flex-column">
        <div class="d-flex profile-atas">
            <div class="profile-foto-profile">
                <img src="{{ $fotoProfilPath }}" alt="Foto Profil" class="foto-profile">
            </div>
            <div class="profile-name-dll">
                <div class="d-flex align-items-center">
                    <div class="username-profile">
                        {{ Auth::user()->username }}
                    </div>
                    <div class="ms-2">
                        <a href="{{ route('edit-profile', ['username' => auth()->user()->username]) }}" wire:navigate class="btn-edit-profile"><svg xmlns="http://www.w3.org/2000/svg"
                                width="20" height="20" fill="currentColor" class="bi bi-pencil-square"
                                viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg></a>
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <div class="total-post me-3">
                        {{ $postCount }} post
                    </div>
                    <div class="total-like">
                        {{ $totalLikes }} likes
                    </div>
                </div>
                <div class="name-profile mt-4">{{ Auth::user()->name }}</div>
                <div class="mt-3" style="color: #ececec; letter-spacing: 1px;">{{ Auth::user()->bio }}</div>
            </div>
        </div>
        <div class="profile-bawah">
            <div class="row d-flex row-profile">
                @foreach($posts as $post)
                <div class="col-md-4 col-profile">
                    <div class="card-post-profile" wire:key="{{ $post->id }}">
                        <a href="{{ route('post.detail', ['id' => $post->id]) }}" wire:navigate>
                            @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="postingan-user">
                            @endif
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>