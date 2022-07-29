<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Events\Commented;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public Post $post;

    public $comment_random_id = '';

    public $content = '';

    protected $listeners = [
        'comment.deleted' => '$refresh',
        'comment.address_reply_to' => 'addressReplyTo',
    ];

    protected $queryString = [
        'comment_random_id' => ['except' => ''],
    ];

    protected $rules = [
        'comment_random_id' => ['nullable', 'string', 'size:6'],
        'content' => ['required', 'string', 'min:3'],
    ];

    protected $messages = [
        'content.required' => "N'avez-vous pas oublié de taper votre commentaire ?",
        'content.min' => 'Votre commentaire est bien trop court !',
    ];

    public function render()
    {
        return view('livewire.comments');
    }

    public function getHasCommentsProperty()
    {
        return $this->post->comments()->exists();
    }

    public function getCommentsProperty()
    {
        return $this->post->comments()->latest()->simplePaginate(10);
    }

    public function getCommentProperty()
    {
        return Comment::whereRandomId($this->comment_random_id)->firstOrFail();
    }

    public function addressReplyTo(string $randomId)
    {
        $this->comment_random_id = $randomId;
    }

    public function storeComment()
    {
        $validated = $this->validate();

        $comment = $this->post->comments()->create([
            'user_id' => auth()->id(),
            'comment_id' => ! $this->comment_random_id ?: Comment::whereRandomId($this->comment_random_id)->whereNotIn('user_id', [auth()->id()])->firstOrFail()->id,
            'content' => $validated['content'],
        ]);

        event(new Commented($comment));

        $this->content = '';
        $this->comment_random_id = '';

        $this->resetPage();
    }
}
