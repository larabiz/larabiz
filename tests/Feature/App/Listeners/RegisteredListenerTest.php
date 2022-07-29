<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Auth\Events\Registered;
use App\Notifications\NewExperienceGain;
use Illuminate\Support\Facades\Notification;

class RegisteredListenerTest extends TestCase
{
    public function test_it_works() : void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->assertEquals(0, $user->sumExperienceGainsPoints());

        event(new Registered($user));

        Notification::assertSentTo($user, NewExperienceGain::class);

        Notification::assertSentToTimes(User::master()->first(), NewUser::class, 1);

        $this->assertEquals(100, $user->sumExperienceGainsPoints());
    }
}