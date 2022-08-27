<?php

namespace App\Notifications\Users\Subscribers;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmSubscription extends Notification
{
    use Queueable;

    public function via() : array
    {
        return ['mail'];
    }

    public function toMail(Subscriber $subscriber) : MailMessage
    {
        return (new MailMessage)
            ->subject('Êtes-vous humain ?')
            ->greeting('Bip boop boop !')
            ->line("Bonjour, potentiel humain. Pourriez-vous me confirmer l'origine biologique de votre abonnement ?")
            ->action('Bip bo… je suis humain !', URL::signedRoute('confirm-subscriber', $subscriber));
    }
}
