<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class RegisteredListenerTest extends TestCase
{
    public function test_it_works() : void
    {
        Notification::fake();

        event(
            new Registered(
                User::factory()->create()
            )
        );

        Notification::assertSentToTimes(User::master()->first(), NewUser::class, 1);
    }
}
