<?php

namespace App\Notifications\Master\Subscribers;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewSubscriber extends Notification
{
    use Queueable;

    public function __construct(
        public Subscriber $subscriber
    ) {
    }

    public function via() : array
    {
        return ['database', 'mail'];
    }

    public function toArray() : array
    {
        return [
            'message' => "{$this->subscriber->email} s'est abonné à la newsletter.",
        ];
    }

    public function toMail() : MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvel abonné à la newsletter')
            ->greeting('Bip boop boop !')
            ->line("Bonjour, humain. {$this->subscriber->email} s'est abonné à la newsletter.");
    }
}
