<?php

namespace Tests\Feature\App\Providers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Master\Users\NewConfirmedUser;

class FortifyServiceProviderTest extends TestCase
{
    public function test_it_sends_a_notification_when_an_email_is_confirmed() : void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        $user->markEmailAsVerified();

        event(new Verified($user));

        Notification::assertSentToTimes(User::master()->first(), NewConfirmedUser::class, 1);
    }
}
