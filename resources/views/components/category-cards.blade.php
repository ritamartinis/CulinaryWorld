<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Categories</h2>
        <a href="{{ route('categories') }}" class="text-decoration-none text-primary hover-grow">SEE ALL <i
                class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row g-3">
        @foreach ($categories->take(4) as $category)
            <x-card :link="route('category', $category)" :image="$category->image" :title="$category->name" />
        @endforeach
    </div>
</div>
