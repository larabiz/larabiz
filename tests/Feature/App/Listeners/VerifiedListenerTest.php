<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Users\NewConfirmedUser;

class VerifiedListenerTest extends TestCase
{
    public function test_it_notifies_user_and_master() : void
    {
        Notification::fake();

        $user = User::factory()->create();

        event(new Verified($user));

        Notification::assertSentTo(User::master()->first(), NewConfirmedUser::class);
    }
}
