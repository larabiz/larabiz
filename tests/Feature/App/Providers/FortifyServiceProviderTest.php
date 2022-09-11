<?php

namespace Tests\Feature\App\Providers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Management\NewConfirmedUser;

class FortifyServiceProviderTest extends TestCase
{
    public function test_it_sends_a_notification_when_an_email_is_confirmed() : void
    {
        Notification::fake();

        $master = User::factory()->master()->create();

        $user = User::factory()->unverified()->create();
        $user->markEmailAsVerified();

        event(new Verified($user));

        Notification::assertSentToTimes($master, NewConfirmedUser::class, 1);
    }
}
