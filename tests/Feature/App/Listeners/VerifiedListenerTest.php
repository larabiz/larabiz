<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use App\Notifications\NewConfirmedUser;
use App\Notifications\NewExperienceGain;
use Illuminate\Support\Facades\Notification;

class VerifiedListenerTest extends TestCase
{
    public function test_it_rewards_user_for_verification_with_experience_points_and_notifies_user_and_master() : void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->assertEquals(0, $user->sumExperienceGainsPoints());

        event(new Verified($user));

        Notification::assertSentTo($user, NewExperienceGain::class);

        Notification::assertSentTo(User::master()->first(), NewConfirmedUser::class);

        $this->assertEquals(100, $user->sumExperienceGainsPoints());
    }
}
