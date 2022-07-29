<?php

namespace App\Providers;

use App\Models\Subscriber;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        View::composer('*', fn ($v) => $v->with([
            'user' => auth()->user(),
        ]));

        View::composer('components.newsletter', fn ($v) => $v->with([
            'subscribersCount' => Subscriber::confirmed()->count(),
        ]));
    }
}
