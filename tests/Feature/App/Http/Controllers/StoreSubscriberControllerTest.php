<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Subscribers\ConfirmSubscription;

class StoreSubscriberControllerTest extends TestCase
{
    public function test_it_stores_subscriber() : void
    {
        Notification::fake();

        $this
            ->post(route('subscribers.store'), ['email' => fake()->safeEmail()])
            ->assertRedirect(route('home'))
            ->assertSessionHas('status', 'Votre abonnement a bien été pris en compte. Un mail de confirmation vous a été envoyé.')
        ;

        Notification::assertSentTo(Subscriber::first(), ConfirmSubscription::class);
    }

    public function test_it_needs_an_email() : void
    {
        $this
            ->post(route('subscribers.store'))
            ->assertInvalid('email')
        ;
    }

    public function test_it_needs_a_valid_email() : void
    {
        $this
            ->post(route('subscribers.store'), ['email' => 'foo'])
            ->assertInvalid('email')
        ;
    }
}
