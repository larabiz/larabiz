<?php

namespace Tests\Feature\App\Http\Livewire;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Notification;
use Tests\Support\DummyNotification;

class NotificationTest extends TestCase
{
    public function test_it_works() : void
    {
        $user = User::factory()->create();

        $user->notify(new DummyNotification);

        Livewire::test(Notification::class, [
            'notification' => $user->unreadNotifications->first(),
        ]);
    }
}
