<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewComment extends Notification
{
    use Queueable;

    public function __construct(
        public string $postTitle,
        public string $commentAuthorUsername,
        public string $linkToComment
    ) {
    }

    public function via() : array
    {
        return ['database', 'mail'];
    }

    public function toArray() : array
    {
        return [
            'actionUrl' => $this->linkToComment,
            'message' => "{$this->commentAuthorUsername} a commenté l'article \"{$this->postTitle}\".",
        ];
    }

    public function toMail() : MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau commentaire')
            ->greeting('Bip boop boop !')
            ->line("Bonjour, humain. {$this->commentAuthorUsername} a commenté l'article « {$this->postTitle} ».")
            ->action('Voir le commentaire', $this->linkToComment);
    }
}
