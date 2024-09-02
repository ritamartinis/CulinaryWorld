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
                <th class="col-5">Name/Email</th>
                <th class="col-3">Role</th>
                <th class="col-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="col-1">{{ $user->id }}</td>
                    <td class="col-5">
                        <div class="d-flex align-items-center">
                            <img src="{{ $user->profile_img ? asset('storage/' . $user->profile_img) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}"
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"/>
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $user->name }}</p>
                                <p class="text-light mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="col-3">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                    <td class="col-3">
                        <button type="button" class="btn btn-link btn-sm text-light" wire:click="edit({{ $user->id }})">Edit</button>
                        <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" wire:click="confirmDelete({{ $user->id }})">Delete</button>
                    </td>
                </tr>
                @if($editMode && $user_id == $user->id)
                    <tr>
                        <td colspan="4">
                            <form wire:submit.prevent="update"> 
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <input type="text" wire:model="name" class="form-control" placeholder="Name"/>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="email" wire:model="email" class="form-control" placeholder="Email"/>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="text" wire:model="username" class="form-control" placeholder="Username"/>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select wire:model="is_admin" class="form-control">
                                            <option value="">Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="0">User</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" wire:click="cancelEdit">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-4">
        @include('components.pagination', ['paginator' => $users])
    </div>

    <!-- Modal for Delete Confirmation -->
    <div wire:ignore class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteUser">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
    Livewire.on('closeModal', modalId => {
        var modalElement = document.getElementById(modalId);
        var modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
    });
});
</script>
