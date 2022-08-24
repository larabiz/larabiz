<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\Users\NewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class RegisteredListenerTest extends TestCase
{
    public function test_it_notifies_the_user_and_master() : void
    {
        Notification::fake();

        $user = User::factory()->create();

        event(new Registered($user));

        Notification::assertSentToTimes(User::master()->first(), NewUser::class, 1);
    }
}
