<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use App\Notifications\NewConfirmedUser;
use Illuminate\Support\Facades\Notification;

class VerifiedListenerTest extends TestCase
{
    public function test_it_works() : void
    {
        Notification::fake();

        event(
            new Verified(
                User::factory()->create()
            )
        );

        Notification::assertSentToTimes(User::master()->first(), NewConfirmedUser::class, 1);
    }
}
