<?php

namespace App\Http\Controllers\Threads;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class CreateThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        if (app()->isProduction()) {
            $this->middleware('master');
        }
    }

    public function __invoke() : View
    {
        return view('threads.create');
    }
}
