@props(['id', 'title', 'category' => null])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ $category ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
                    enctype="multipart/form-data" class="">
                    @csrf
                    @if ($category)
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ $category->name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image"
                            {{ $category ? '' : 'required' }}>
                    </div>
                    <button type="submit"
                        class="btn btn-primary">{{ $category ? 'Save Changes' : 'Add Category' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
