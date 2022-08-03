<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class Listing extends Component
{
    public $notifications;

    public function mount()
    {
        $this->fetchNotifications();
    }

    public function render()
    {
        return view('livewire.notifications.listing');
    }

    public function fetchNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);

        $this->notifications = collect();
    }
}
