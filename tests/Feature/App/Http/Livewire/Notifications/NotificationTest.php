<?php

namespace Tests\Feature\App\Http\Livewire\Notifications;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Tests\Support\DummyNotification;
use App\Http\Livewire\Notifications\Notification;

class NotificationTest extends TestCase
{
    public function test_it_works() : void
    {
        $user = User::factory()->create();

        $user->notify(new DummyNotification);

        Livewire::test(Notification::class, [
            'notification' => $user->notifications->first(),
        ])
            ->assertSet('notification', $user->notifications->first());
    }
}
