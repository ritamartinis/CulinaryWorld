@auth
    <div class="bg-gray-100 p-4 rounded-lg shadow-lg mx-auto" style="max-width: 700px;">
        <form method="POST" action="/recipes/{{ $recipe->id }}/comments">
            @csrf
            <header class="d-flex align-items-center mb-4">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40" class="rounded-circle">
                <h2 class="ms-3 mb-0">Review this Recipe</h2>
            </header>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <div id="rating" class="d-flex align-items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star fa-2x text-secondary rating-star" data-value="{{ $i }}"></i>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-value" value="1">
                <x-error name="rating" />
            </div>
            <div class="mb-3">
                <textarea name="body" class="form-control" rows="5" placeholder="Write your comment here!" required></textarea>
                @error('body')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Review</button>
            </div>
        </form>
    </div>
@else
    <p class="font-semibold text-center"><a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">login</a> to review this recipe!</p>
@endauth

@push('scripts')
    <script src="{{ asset('js/rating.js') }}"></script>
@endpush
