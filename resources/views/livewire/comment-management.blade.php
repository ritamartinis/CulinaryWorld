<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-dark table-striped align-middle mb-0">
        <thead>
            <tr>
                <th class="col-1">ID</th>
                <th class="col-3">User</th>
                <th class="col-3">Recipe</th>
                <th class="col-3">Comment</th>
                <th class="col-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td class="col-1">{{ $comment->id }}</td>
                    <td class="col-3">{{ $comment->user->name }}</td>
                    <td class="col-3">{{ $comment->recipe->title }}</td>
                    <td class="col-3">{{ $comment->body }}</td>
                    <td class="col-2">
                        <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" wire:click="confirmDelete({{ $comment->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-4">
        @include('components.pagination', ['paginator' => $comments])
    </div>

    <!-- Modal for Delete Confirmation -->
    <div wire:ignore class="modal fade" class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this comment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteComment">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('show-delete-modal', () => {
                console.log('show-delete-modal event received');
                var deleteModalEl = document.getElementById('confirmDeleteModal');
                var deleteModal = new bootstrap.Modal(deleteModalEl);
                deleteModal.show();
            });

            Livewire.on('close-modal', () => {
                console.log('close-modal event received');
                var deleteModalEl = document.getElementById('confirmDeleteModal');
                if (deleteModalEl) {
                    var deleteModal = bootstrap.Modal.getInstance(deleteModalEl);
                    if (deleteModal) deleteModal.hide();
                }
            });
        });
    </script>
</div>
