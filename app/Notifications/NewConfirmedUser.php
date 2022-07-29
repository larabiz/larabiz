<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewConfirmedUser extends Notification
{
    use Queueable;

    public function __construct(
        public User $user
    ) {
    }

    public function via() : array
    {
        return ['database'];
    }

    public function toArray() : array
    {
        return [
            'message' => "{$this->user->username} a validé son adresse e-mail.",
        ];
    }
}