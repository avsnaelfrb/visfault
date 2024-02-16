<div>
    @livewire('sidebar')
    <div class="konten-detail">
        <div class="card-detail d-flex">
            <div class="card-image">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="detail-image">
                @endif
            </div>
            <div class="detail-konten flex-fill">

                <div class="card-header d-flex  justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div>
                            <img src="{{ $fotoProfilPath }}" alt="" class="foto-profile-detail">
                        </div>
                        <div>
                            <a href="{{ route('profile.show', ['username' => $post->user_id  ? $post->user->username : 'username']) }}"
                                wire:navigate class="username-detail">{{ $post->user_id ? $post->user->username :
                                'username'
                                }}</a>
                        </div>
                    </div>
                    <div>
                        @if(Auth::id() === $post->user_id)
                        <a href="{{ route('edit-post', ['postId' => $post->id]) }}" class="button-edit"
                            wire:navigate>Edit Post</a>
                        @endif
                    </div>
                </div>

                <div class="detail-middle">
                    <div class="mb-4">
                        <div class="middle-username d-flex ">
                            <div class="mt-1">
                                <img src="{{ $fotoProfilPath }}" alt="" class="foto-profile-detail">
                            </div>
                            <div class="ms-2">
                                <div class="d-flex align-items-center dpdp">
                                    <div>
                                        {{ $post->user_id ? $post->user->username : 'username' }}
                                    </div>
                                    <div>
                                        <small class="tanggal-post"> {{$post->created_at->diffForHumans() }} </small>
                                    </div>
                                </div>
                                <p class="deskripsi-post-detail dpdp">{{ $post->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    @foreach($comments as $comment)
                    <div class="komen-section mb-3">
                        <div>
                            <div class="d-flex">
                                <div class="mt-1">
                                    <img src="{{ asset('storage/foto-profil/' . ($comment->user->foto_profil ?: 'default.png')) }}"
                                        alt="Commenter Profile Picture" class="foto-profile-detail">
                                </div>
                                <div class="ms-2">
                                    <div class="d-flex align-items-center dpdp"><a href="" class="username-komen"
                                            wire:navigate>{{
                                            $comment->user->username }}</a><small class="tanggal-komen">{{
                                            $comment->created_at->diffForHumans() }}</small></div>
                                    <div class="isi-komen dpdp">{{ $comment->komen }}</div>
                                    <div>
                                        <button wire:click="startReply({{ $comment->id }})"
                                            class="btn-replay-komen">Reply</button>
                                        <button wire:click="$set('showKomen', true)" class="btn-replay-komen">View
                                            reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if ($showKomen)
                        <div wire:transition>
                            @foreach($comment->replies as $reply)
                            <div class="reply-komen mt-3 ms-5">
                                <div class="d-flex">
                                    <div class="mt-1">
                                        <img src="{{ asset('storage/foto-profil/' . ($reply->user->foto_profil ?: 'default.png')) }}"
                                            alt="Replier Profile Picture" class="foto-profile-detail">
                                    </div>
                                    <div class="ms-2">
                                        <div class="d-flex align-items-center dpdp">
                                            <a href="" class="username-replay-komen" wire:navigate>{{ $reply->user->username
                                                }}</a>
                                            <small class="tanggal-komen">{{ $reply->created_at->diffForHumans() }} </small>
                                        </div>
                                        <div class="isi-replay dpdp">{{ $reply->replay_komen }}</div>
                                        <button wire:click="startReply({{ $comment->id }})"
                                            class="btn-replay-komen">Reply</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
    
                            <!-- Form untuk menambahkan balasan -->
                            @if($replyingTo == $comment->id)
                            <div class="form-isi-replay">
                                <form wire:submit="addReply({{ $comment->id }})">
                                    <input type="text" wire:model="replay_komen" placeholder="Reply komen..."
                                        class="form-replay-komen" autofocus></input>
                                    @error('replay_komen') <span>{{ $message }}</span> @enderror
                                    <button type="submit" class="btn-kirim-reply">Kirim</button>
                                    <button type="button" wire:click="cancelReply" class="btn-cancel-reply">Batal</button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach

                </div>

                <div class="detail-bottom">
                    <div class="d-flex align-items-center">
                        <div>
                            @if (Auth::user()->likesPost($post))
                            <button wire:click="unlikePost" class="btn-unlike"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="25" height="25" fill="currentColor" class="bi bi-heart-fill"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" 4
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                </svg>
                            </button>
                            @else
                            <button wire:click="likePost" class="btn-like"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                </svg>
                            </button>
                            @endif
                        </div>
                        <div>
                            <label for="komen" class="icon-komen"><svg xmlns="http://www.w3.org/2000/svg" width="26"
                                    height="26" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                    <path
                                        d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                                </svg></label>
                        </div>
                    </div>
                    <div class="jumlah-like">{{ $likeCount }} Likes</div>

                    <div class="form-komen">
                        <form wire:submit="addComment">
                            <div class="d-flex align-items-center ms-3">
                                <div>
                                    <img src="{{ asset('storage/foto-profil/' . (Auth::user()->foto_profil ?: 'default.png')) }}"
                                        alt="" class="foto-profile-start-komen">
                                </div>
                                <div>
                                    <div class="d-flex">
                                        <div class="ms-3">
                                            <input type="text" wire:model="komen" placeholder="Tambahkan komentar..."
                                                class="form-isi-komen" id="komen"></input>
                                        </div>
                                        <div class="ms-5">
                                            <button type="submit" class="btn-post-komen">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



