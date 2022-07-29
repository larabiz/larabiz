<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewComment extends Notification
{
    use Queueable;

    public function __construct(
        public Comment $comment
    ) {
    }

    public function via() : array
    {
        return ['database', 'mail'];
    }

    public function toArray() : array
    {
        return [
            'actionUrl' => route('posts.comments.show', $this->comment),
            'message' => "{$this->comment->user->username} a commenté l'article \"{$this->comment->post->title}\".",
        ];
    }

    public function toMail() : MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau commentaire')
            ->line("Un nouveau commentaire a été posté sur l'article \"{$this->comment->post->title}\".")
            ->action('Voir le commentaire', route('posts.comments.show', $this->comment));
    }
}
