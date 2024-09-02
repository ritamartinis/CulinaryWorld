@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-light">Categories</h2>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a>
        </div>
        <div class="row g-3">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="card h-100">
                        <a href="{{ route('category', $category->id) }}">
                            <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 300px; object-fit: cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <x-category-modal id="editCategoryModal{{ $category->id }}" title="Edit Category" :category="$category" />
            @endforeach
        </div>

        <div class="d-flex justify-content-end mt-4">
            @include('components.pagination', ['paginator' => $categories])
        </div>
    </div>

    <x-category-modal id="addCategoryModal" title="Add Category" />
@endsection
