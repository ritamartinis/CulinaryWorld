@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Check out all the recipes below</h2>
        <div class="row g-3">
            @foreach ($recipes as $recipe)
                <x-card :link="route('recipe', $recipe)" :image="$recipe->image" :title="$recipe->title" />
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-4">
            @include('components.pagination', ['paginator' => $recipes])
        </div>
    </div>
@endsection
