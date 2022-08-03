<?php

namespace App\Http\Livewire\Comments;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public Post $post;

    protected $listeners = [
        'comment.created' => '$refresh',
        'comment.deleted' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.comments.listing');
    }

    public function getCommentsProperty()
    {
        return $this->post
            ->comments()
            ->with('user')
            ->whereNull('comment_id')
            ->get();
    }
}
