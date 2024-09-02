@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">{{ ucwords($category->name) }}</h2>
        <div class="row g-3">
            @foreach ($recipes as $recipe)
                <x-card :link="route('recipe', $recipe->id)" :image="$recipe->image" :title="$recipe->title" />
            @endforeach
        </div>
    </div>
@endsection
