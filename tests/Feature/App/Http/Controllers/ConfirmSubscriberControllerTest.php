<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Subscriber;
use Illuminate\Support\Facades\URL;

class ConfirmSubscriberControllerTest extends TestCase
{
    public function test_it_confirms_subscriber() : void
    {
        $subscriber = Subscriber::factory()->create(['confirmed_at' => null]);

        $this
            ->get(URL::signedRoute('confirm-subscriber', $subscriber))
            ->assertRedirect(route('home'))
            ->assertSessionHas('status', 'Votre abonnement a bien été confirmé, à bientôt !')
        ;

        $this->assertNotNull($subscriber->fresh()->confirmed_at);
    }

    public function test_it_needs_a_signed_URL() : void
    {
        $subscriber = Subscriber::factory()->create(['confirmed_at' => null]);

        $this
            ->get(route('confirm-subscriber', $subscriber))
            ->assertForbidden()
        ;
    }

    public function test_it_throws_404_when_subscriber_already_confirmed() : void
    {
        $subscriber = Subscriber::factory()->create();

        $this
            ->get(URL::signedRoute('confirm-subscriber', $subscriber))
            ->assertNotFound()
        ;
    }
}
