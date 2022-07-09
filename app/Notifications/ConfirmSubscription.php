<?php

namespace App\Notifications;

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
            ->greeting('Vous y êtes presque !')
            ->line("Il ne vous reste plus qu'à confirmer votre abonnement en cliquant sur le bouton ci-dessous.")
            ->action('Je suis humain', URL::signedRoute('confirm-subscriber', $subscriber))
            ->line('*Merci infiniment et puisse ' . config('app.name') . ' avoir un impact positif sur votre vie.*');
    }
}
