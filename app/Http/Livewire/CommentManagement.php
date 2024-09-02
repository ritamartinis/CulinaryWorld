<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;

class CommentManagement extends Component
{
    use WithPagination;

    public $deleteCommentId;

    protected $listeners = ['deleteConfirmed' => 'deleteComment'];

    public function render()
    {
        $comments = Comment::with('user', 'recipe')->paginate(5);

        return view('livewire.comment-management', [
            'comments' => $comments,
        ]);
    }

    public function confirmDelete($id)
    {
        $this->deleteCommentId = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteComment()
    {
        Comment::find($this->deleteCommentId)->delete();
        session()->flash('message', 'Comment Deleted Successfully.');
        $this->deleteCommentId = null;

        // Fechar o modal manualmente
        $this->dispatchBrowserEvent('close-modal');
    }
}


