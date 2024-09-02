<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Featured Recipes</h2>
        <a href="{{ route('recipes') }}" class="text-decoration-none text-primary hover-grow">SEE ALL <i
                class="bi bi-chevron-right"></i>
        </a>
    </div>
    <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($recipes->chunk(3) as $chunk)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <div class="row">
                        @foreach ($chunk as $recipe)
                            <div class="col-md-4">
                                <a href="{{ route('recipe', $recipe->id) }}">
                                    <div class="card mb-4" style="overflow: hidden;">
                                        <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top"
                                            alt="{{ $recipe->title }}" style="height: 300px; object-fit: cover;">
                                        <div class="card-img-overlay d-flex align-items-end p-0">
                                            <h5 class="card-title bg-dark text-white w-100 text-center m-0 p-2">
                                                {{ $recipe->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
