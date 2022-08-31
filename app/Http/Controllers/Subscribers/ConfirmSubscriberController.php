<?php

namespace App\Http\Controllers\Subscribers;

use App\Models\User;
use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Notifications\Management\Subscribers\NewSubscriber;

class ConfirmSubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed');
    }

    public function __invoke(Subscriber $subscriber) : RedirectResponse
    {
        abort_if($subscriber->confirmed_at, 404);

        $subscriber->update(['confirmed_at' => now()]);

        User::master()->first()?->notify(new NewSubscriber($subscriber));

        return to_route('home')->with('status', 'Votre abonnement a bien été confirmé, à bientôt !');
    }
}
