<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        View::composer('*', function ($view) {
            $view->with('user', auth()->user());
        });
    }
}
