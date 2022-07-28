<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewExperienceGain extends Notification
{
    use Queueable;

    public function __construct(
        public int $points,
        public string $message
    ) {
    }

    public function via() : array
    {
        return ['database'];
    }

    public function toArray() : array
    {
        return [
            'points' => $this->points,
            'message' => $this->message,
        ];
    }
}
