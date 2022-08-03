<?php

namespace App\Http\Livewire\Comments;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Events\Commented;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    public Post $post;

    public $content = '';

    protected $rules = [
        'content' => ['required', 'string', 'min:3'],
    ];

    protected $messages = [
        'content.required' => "N'avez-vous pas oublié de taper votre commentaire ?",
        'content.min' => 'Votre commentaire est bien trop court !',
    ];

    public function render()
    {
        return view('livewire.comments.form');
    }

    public function storeComment()
    {
        $this->authorize('create', Comment::class);

        $this->validate();

        $comment = $this->post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        event(new Commented($comment));

        $this->emit('comment.created');

        $this->content = '';
    }
}
