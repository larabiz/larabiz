<?php

namespace Tests\Feature\App\Providers;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;
use App\Notifications\NewConfirmedUser;
use Illuminate\Support\Facades\Notification;

class FortifyServiceProviderTest extends TestCase
{
    public function test_it_sends_a_notification_when_a_user_registers() : void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        event(new Registered($user));

        Notification::assertSentToTimes(User::master()->first(), NewUser::class, 1);
    }

    public function test_it_sends_a_notification_when_an_email_is_confirmed() : void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        $user->markEmailAsVerified();

        event(new Verified($user));

        Notification::assertSentToTimes(User::master()->first(), NewConfirmedUser::class, 1);
    }
}
