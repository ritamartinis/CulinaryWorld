@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Check out all the categories below</h2>
        <div class="row g-3">
            @foreach ($categories as $category)
                <x-card :link="route('category', $category)" :image="$category->image" :title="$category->name" />
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-4">
            @include('components.pagination', ['paginator' => $categories])
        </div>
    </div>
@endsection




