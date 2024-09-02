@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <div class="recipe-container row mb-4 py-5 text-white p-4 rounded">
            <div class="col-md-8"> 
                <img src="{{ asset('storage/' . $recipe->image) }}" class="img-fluid custom-img-size rounded " alt="{{ $recipe->title }}">
            </div>
            <div class="col-md-4 recipe-text">
                <div class="category-badge bg-dark text-light rounded p-2 mb-2 d-inline-block ">
                    {{ $recipe->category->name }}
                </div>
                <h1 class="mt-5 text-danger text-center">{{ $recipe->title }}</h1>
                <p class="mt-4">{{ $recipe->description }}</p>
            </div>
        </div>
        @include('components.favorite-buttons')

        <div class="row mt-5 recipe-text">
            <div class="col-md-4">
                <h2 class="text-danger">Ingredients</h2>
                <ul class="list-unstyled border-start border-danger ps-3">
                    @foreach (explode(',', $recipe->ingredients) as $ingredient)
                        <li class="border-bottom py-2">{{ $ingredient }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8 recipe-text">
                <h2 class="text-danger">How to Make</h2>
                <ol class="list-unstyled border-start border-danger ps-3">
                    @foreach (explode("\n", $recipe->instructions) as $instruction)
                        @if (trim($instruction))
                            <li class="py-2">{{ $instruction }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <section class="mt-5">
        <h2 class="text-center text-danger display-4">Reviews ({{ $recipe->comments->count() }})</h2>
        @include('components._add-comment')

        <div class="container">
            @foreach ($recipe->comments as $comment)
                @include('components.comment', ['comment' => $comment])
            @endforeach
        </div>
    </section>
    </div>
@endsection
