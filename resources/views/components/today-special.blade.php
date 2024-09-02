<div class="custom-bg-section">
    <div class="container py-5">
        <h2 class="text-white mb-4">Try our special today</h2>
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <a href="{{ route('recipe', $latestRecipe->id) }}" class="text-danger text-decoration-none">
                    <img src="{{ asset('storage/' . $latestRecipe->image) }}" class="img-fluid custom-img-size rounded"
                        alt="{{ $latestRecipe->title }}">
                </a>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center recipe-text">
                <h3 class="text-center">
                    <a href="{{ route('recipe', $latestRecipe->id) }}" class="text-danger text-decoration-none">
                        {{ $latestRecipe->title }}
                    </a>
                </h3>
                <p class="text-white mt-3">{{ $latestRecipe->description }}</p>
            </div>
        </div>
    </div>
</div>
