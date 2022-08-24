<?php

namespace App\Notifications\Comments;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewComment extends Notification
{
    use Queueable;

    public function __construct(
        public Comment $comment
    ) {
    }

    public function via() : array
    {
        return ['database'];
    }

    public function toArray() : array
    {
        return [
            'actionUrl' => route('posts.show', [$this->comment->post->random_id, $this->comment->post->slug]),
            'message' => "{$this->comment->user->username} a commenté l'article \"{$this->comment->post->title}\".",
        ];
    }
}
