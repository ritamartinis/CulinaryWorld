<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserManagement extends Component
{
    use WithPagination;

    public $name, $email, $is_admin, $user_id, $username, $deleteUserId;
    public $editMode = false;

    public function render()
    {
        $users = User::paginate(10);

        return view('livewire.user-management', [
            'users' => $users,
        ]);
    }

    public function edit($id)
    {
        $this->editMode = true;
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->is_admin = $user->is_admin;
    }
    
    public function cancelEdit()
    {
        $this->editMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')->ignore($this->user_id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user_id)],
            'is_admin' => 'required',
        ]);

        User::findOrFail($this->user_id)->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'is_admin' => $this->is_admin,
        ]);

        session()->flash('message', 'User Updated Successfully.');

        $this->resetInputFields();
        $this->emit('userUpdated');
        $this->editMode = false;
    }

    public function deleteUser()
{
    User::find($this->deleteUserId)->delete();
    session()->flash('message', 'User Deleted Successfully.');
    $this->emit('userUpdated');
    $this->deleteUserId = null;
    $this->dispatchBrowserEvent('closeModal', 'confirmDeleteModal');
}


    public function confirmDelete($id)
    {
        $this->deleteUserId = $id;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->is_admin = '';
        $this->user_id = '';
    }
}
