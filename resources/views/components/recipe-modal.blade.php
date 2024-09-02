@props(['id', 'title', 'recipe' => null, 'categories'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ $recipe ? route('admin.recipes.update', $recipe->id) : route('admin.recipes.store') }}" enctype="multipart/form-data" class="">
                    @csrf
                    @if ($recipe)
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $recipe->title ?? '') }}" required>
                        <x-error name="title" />
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-error name="category_id" />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" {{ $recipe ? '' : 'required' }}>
                        <x-error name="image" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" required>{{ old('description', $recipe->description ?? '') }}</textarea>
                        <x-error name="description" />
                    </div>
                    <div class="mb-3">
                        <label for="ingredients" class="form-label">Ingredients (separated with a comma)</label>
                        <textarea name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" required>{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
                        <x-error name="ingredients" />
                    </div>
                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions</label>
                        <textarea name="instructions" class="form-control @error('instructions') is-invalid @enderror" id="instructions" required>{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
                        <x-error name="instructions" />
                    </div>
                    <div class="mb-3">
                        <label for="prep_time" class="form-label">Preparation Time (in minutes)</label>
                        <input type="number" name="prep_time" class="form-control @error('prep_time') is-invalid @enderror" id="prep_time" value="{{ old('prep_time', $recipe->prep_time ?? '') }}" required>
                        <x-error name="prep_time" />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $recipe ? 'Save Changes' : 'Add Recipe' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
