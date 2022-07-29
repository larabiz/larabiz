<?php

namespace Tests\Feature\App\Http\Livewire;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Notifications;
use Tests\Support\DummyNotification;

class NotificationsTest extends TestCase
{
    public function test_it_fetches_notifications_on_mount() : void
    {
        $this->actingAs($user = User::factory()->create());

        $user->notify(new DummyNotification);

        $component = Livewire::test(Notifications::class)
            ->assertViewIs('livewire.notifications');

        // The component fetched 1 notification.
        $this->assertCount(1, $component->viewData('notifications'));
    }

    public function test_it_marks_all_notifications_as_read() : void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $user->notify(new DummyNotification);

        $component = Livewire::test(Notifications::class);

        // The component fetched 1 notification.
        $this->assertCount(1, $component->viewData('notifications'));

        $component->call('markAllAsRead');

        // Once marked as read, it should have none.
        $this->assertCount(0, $component->viewData('notifications'));
    }
}
