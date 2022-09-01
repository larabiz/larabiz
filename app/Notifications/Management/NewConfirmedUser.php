<?php

namespace App\Notifications\Management;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewConfirmedUser extends Notification
{
    use Queueable;

    public function __construct(
        public User $user
    ) {
    }

    public function via() : array
    {
        return ['database', 'mail'];
    }

    public function toArray() : array
    {
        return [
            'message' => "{$this->user->username} vient de terminer son inscription.",
        ];
    }

    public function toMail() : MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvel utilisateur')
            ->greeting('Bip boop boop !')
            ->line("Bonjour, humain. {$this->user->username} vient de terminer son inscription.");
    }
}
