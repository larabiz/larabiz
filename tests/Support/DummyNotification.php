<?php

namespace Tests\Support;

use Illuminate\Notifications\Notification;

class DummyNotification extends Notification
{
    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return ['message' => 'Foo'];
    }
}
