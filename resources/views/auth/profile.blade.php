@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card h-100 d-flex justify-content-center bg-dark text-white">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <img src="{{ $user->profile_img ? asset('storage/' . $user->profile_img) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}" alt="profile_img" class="rounded-circle img-fluid" style="width: 300px; height: 300px; object-fit: cover;">
                        <div class="mt-3">
                            <h4>{{ $user->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card mb-3 bg-dark text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->name }}
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->username }}
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->email }}
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Account created at</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->created_at }}
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Last updated</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->updated_at->diffForHumans() }}
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Edição -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Info</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control text-dark" id="name" value="{{ old('name', $user->name) }}" required>
                                <x-error name="name" />
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control text-dark" id="username" value="{{ old('username', $user->username) }}" required>
                                <x-error name="username" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control text-dark" id="email" value="{{ old('email', $user->email) }}" required>
                                <x-error name="email" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control text-dark" id="password">
                                <x-error name="password" />
                            </div>
                            <div class="mb-3">
                                <label for="profile_img" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_img" class="form-control text-dark" id="profile_img">
                                <x-error name="profile_img" />
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histórico de Comentários -->
        <div class="row gutters-sm">
            <div class="col-md-12">
                <div class="card mb-3 bg-dark text-white">
                    <div class="card-header text-center d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Your Comments</h5>
                        <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#commentsSection" aria-expanded="true" aria-controls="commentsSection">
                            <i class="bi bi-chevron-up"></i>
                        </button>
                    </div>
                    <div id="commentsSection" class="collapse show" style="max-height: 300px; overflow-y: auto;">
                        <div class="card-body">
                            @if($user->comments->isEmpty())
                                <p class="text-center">You haven't reviewed any recipe yet.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach ($user->comments as $comment)
                                        <li class="list-group-item bg-dark text-white">
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <p class="font-bold">
                                                        <strong>In the recipe:</strong> 
                                                        <a href="{{ route('recipe', $comment->recipe->id) }}" class="text-decoration-none text-danger">
                                                            <i class="bi bi-receipt"></i> 
                                                            <span class="fw-bold">{{ $comment->recipe->title }}</span>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if ($comment->rating)
                                                        <div class="text-warning">
                                                            @for ($i = 0; $i < $comment->rating; $i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                            @for ($i = $comment->rating; $i < 5; $i++)
                                                                <i class="far fa-star"></i>
                                                            @endfor
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="mt-2">{{ $comment->body }}</p>
                                                <p class="text-sm mb-0 text-muted">Reviewed in <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time></p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histórico de Receitas Salvas -->
        <div class="row gutters-sm">
            <div class="col-md-12">
                <div class="card mb-3 bg-dark text-white">
                    <div class="card-header text-center d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recipes you liked</h5>
                        <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#savedRecipesSection" aria-expanded="true" aria-controls="savedRecipesSection">
                            <i class="bi bi-chevron-up"></i>
                        </button>
                    </div>
                    <div id="savedRecipesSection" class="collapse show" style="max-height: 300px; overflow-y: auto;">
                        <div class="card-body">
                            @if($user->favorites->isEmpty())
                                <p class="text-center">You haven't liked any recipe yet.</p>
                            @else
                                <div class="row g-3">
                                    @foreach ($user->favorites as $recipe)
                                        <x-card :link="route('recipe', $recipe->id)" :image="$recipe->image" :title="$recipe->title">
                                            <small class="text-muted">Saved on: {{ $recipe->pivot->created_at->format('d/m/Y') }}</small>
                                        </x-card>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
