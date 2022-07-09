<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;

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

        return to_route('home')->with('status', 'Votre abonnement a bien été confirmé, à bientôt !');
    }
}
