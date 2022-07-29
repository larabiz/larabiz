<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Comment extends Component
{
    use AuthorizesRequests;

    public \App\Models\Comment $comment;

    public $frameless = false;

    public function render()
    {
        return view('livewire.comment');
    }

    public function removeComment(bool $redirect = false)
    {
        $this->authorize('delete', $this->comment);

        $this->comment->delete();

        if ($redirect) {
            return to_route('posts.show', [$this->comment->post->random_id, $this->comment->post->slug]);
        } else {
            $this->emitUp('comment.deleted');
        }
    }
}
