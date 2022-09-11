<?php

namespace Tests\Feature\App\Notifications;

use Tests\TestCase;
use App\Models\Subscriber;
use App\Notifications\ConfirmSubscription;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmSubscriptionTest extends TestCase
{
    public function test_it_works() : void
    {
        $notification = new ConfirmSubscription;

        $this->assertEquals(['mail'], $notification->via());

        $mail = $notification->toMail(Subscriber::factory()->create());

        $this->assertInstanceOf(MailMessage::class, $mail);
    }
}
