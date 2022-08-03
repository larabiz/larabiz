<?php

namespace App\Http\Livewire\Comments;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Comment extends Component
{
    use AuthorizesRequests;

    public \App\Models\Comment $comment;

    public function render()
    {
        return view('livewire.comments.comment');
    }

    public function delete()
    {
        $this->authorize('delete', $this->comment);

        $this->comment->delete();

        $this->emitUp('comment.deleted');
    }
}
