<?php

namespace App\Http\Controllers\Subscribers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Notifications\Subscribers\ConfirmSubscription;

class StoreSubscriberController extends Controller
{
    public function __invoke(Request $request) : RedirectResponse
    {
        $input = $request->validate(
            ['email' => ['required', 'email', 'unique:subscribers,email']],
            [
                'email.required' => 'Votre adresse e-mail est requise.',
                'email.email' => 'Votre adresse e-mail est invalide.',
                'email.unique' => 'Cette adresse e-mail est déjà prise.',
            ]
        );

        Subscriber::create($input)->notify(new ConfirmSubscription);

        return to_route('home')
            ->with('status', 'Votre abonnement a bien été pris en compte. Un mail de confirmation vous a été envoyé.');
    }
}
