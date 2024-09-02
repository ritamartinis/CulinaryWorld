<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($recipes as $index => $recipe)
            <div class="carousel-item @if ($index === 0) active @endif">
                <a href="{{ route('recipe', $recipe->id) }}">
                    <img src="{{ asset('storage/' . $recipe->image) }}" class="d-block w-100" alt="{{ $recipe->title }}"
                        style="height: 600px; object-fit: cover;">
                </a>
                <div class="carousel-caption d-none d-md-block text-start">
                    @if ($recipe->category)
                        <div class="category-badge bg-dark text-light rounded p-2 mb-2 d-inline-block">
                            {{ $recipe->category->name }}
                        </div>
                    @endif
                    <p class="h4 fw-bold">{{ $recipe->title }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="carousel-indicators-vertical">
        @foreach ($recipes as $index => $recipe)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}"
                class="@if ($index === 0) active @endif" aria-current="true"
                aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
</div>
