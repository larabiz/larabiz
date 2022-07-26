<?php

namespace App\Notifications;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSubscriber extends Notification
{
    use Queueable;

    public function __construct(
        public Subscriber $subscriber
    ) {
    }

    public function via() : array
    {
        return ['database'];
    }

    public function toArray() : array
    {
        return [
            'message' => "{$this->subscriber->email} s'est abonné à la newsletter.",
        ];
    }
}
