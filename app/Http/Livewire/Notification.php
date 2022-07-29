<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends Component
{
    public DatabaseNotification $notification;

    public function render()
    {
        return view('livewire.notification');
    }
}
