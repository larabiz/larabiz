<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Events\Commented;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Comments extends Component
{
    use AuthorizesRequests, WithPagination;

    public Post $post;

    public $commentRepliedToRandomId = '';

    public $content = '';

    protected $listeners = [
        'comment.deleted' => '$refresh',
        'comment.address_reply_to' => 'addressReplyTo',
    ];

    protected $queryString = [
        'commentRepliedToRandomId' => ['except' => ''],
    ];

    protected $rules = [
        'commentRepliedToRandomId' => ['nullable', 'string', 'size:6'],
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
        return $this->post->comments()->with('user')->simplePaginate(10);
    }

    public function getCommentProperty()
    {
        return Comment::whereRandomId($this->commentRepliedToRandomId)->firstOrFail();
    }

    public function addressReplyTo(string $randomId)
    {
        $this->commentRepliedToRandomId = $randomId;
    }

    public function storeComment()
    {
        $this->authorize('create', Comment::class);

        $validated = $this->validate();

        $comment = $this->post->comments()->create([
            'user_id' => auth()->id(),
            'comment_id' => Comment::whereRandomId($this->commentRepliedToRandomId)
                ->whereNotIn('user_id', [auth()->id()])
                ->first()
                ?->id,
            'content' => $validated['content'],
        ]);

        event(new Commented($comment));

        $this->resetState();
    }

    public function resetState()
    {
        $this->content = '';
        $this->commentRepliedToRandomId = '';
    }
}
