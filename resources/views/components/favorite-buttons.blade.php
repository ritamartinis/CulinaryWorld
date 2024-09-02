@auth
    <!-- like -->
    <form method="POST" action="{{ route('recipes.favorite', $recipe->id) }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-success btn-sm">
            <i class="fas fa-heart"></i> Add as a Favorite
        </button>
    </form>

    <!-- unlike -->
    <form method="POST" action="{{ route('recipes.notfavorite', $recipe->id) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">
            <i class="fas fa-heart-broken"></i> Remove from favorites
        </button>
    </form>
@endauth
