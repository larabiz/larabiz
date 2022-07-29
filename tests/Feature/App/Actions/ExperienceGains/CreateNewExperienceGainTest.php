<?php

namespace Tests\Feature\App\Actions\ExperienceGains;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\NewExperienceGain;
use Illuminate\Support\Facades\Notification;
use App\Actions\ExperienceGains\CreateNewExperienceGain;

class CreateNewExperienceGainTest extends TestCase
{
    public function test_it_creates_a_new_experience_gain_and_does_not_notify_the_user() : void
    {
        Notification::fake();

        (new CreateNewExperienceGain)->create(100, 'Foo', $user = User::factory()->create());

        $this->assertEquals(100, $user->sumExperienceGainsPoints());

        Notification::assertNotSentTo($user, NewExperienceGain::class);
    }

    public function test_it_creates_a_new_experience_gain_and_notifies_the_user() : void
    {
        Notification::fake();

        (new CreateNewExperienceGain)->create(100, 'Foo', $user = User::factory()->create(), true);

        $this->assertEquals(100, $user->sumExperienceGainsPoints());

        Notification::assertSentToTimes($user, NewExperienceGain::class, 1);
    }
}
