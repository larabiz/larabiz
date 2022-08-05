<?php

namespace Tests\Feature\App\Http\Livewire\Notifications;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Tests\Support\DummyNotification;
use App\Http\Livewire\Notifications\Listing;

class ListingTest extends TestCase
{
    public function test_it_fetches_notifications_on_mount() : void
    {
        $this->actingAs($user = User::factory()->create());

        $user->notify(new DummyNotification);

        $component = Livewire::test(Listing::class)
            ->assertViewIs('livewire.notifications.listing');

        // The component fetched 1 notification.
        $this->assertCount(1, $component->viewData('notifications'));
    }

    public function test_it_marks_all_notifications_as_read() : void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $user->notify(new DummyNotification);

        $component = Livewire::test(Listing::class);

        // The component fetched 1 notification.
        $this->assertCount(1, $component->viewData('notifications'));

        $component->call('markAllAsRead');

        // Once marked as read, it should have none.
        $this->assertCount(0, $component->viewData('notifications'));
    }
}
