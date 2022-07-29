<?php

namespace App\Notifications;

use App\Models\User;
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

    public function toArray(User $notifiable) : array
    {
        return [
            'actionUrl' => route('posts.comments.show', $this->comment),
            'message' => $this->comment->reply_to && 'benjamincrozat@me.com' !== $notifiable->email
                ? "{$this->comment->user->username} a répondu à votre commentaire sur l'article \"{$this->comment->post->title}\"."
                : "{$this->comment->user->username} a commenté l'article \"{$this->comment->post->title}\".",
        ];
    }

    public function toMail(User $notifiable) : MailMessage
    {
        if ($this->comment->reply_to && 'benjamincrozat@me.com' !== $notifiable->email) {
            return (new MailMessage)
                ->subject('Réponse à votre commentaire')
                ->line("{$this->comment->user->username} a répondu à votre commentaire sur l'article \"{$this->comment->post->title}\".")
                ->action('Voir la réponse', route('posts.comments.show', $this->comment));
        } else {
            return (new MailMessage)
                ->subject('Nouveau commentaire')
                ->line("Un nouveau commentaire a été posté sur l'article \"{$this->comment->post->title}\".")
                ->action('Voir le commentaire', route('posts.comments.show', $this->comment));
        }
    }
}
