<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditUserPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('password.confirm');
    }

    public function __invoke(Request $request) : View
    {
        return view('user.password')->with([
            'user' => $request->user(),
        ]);
    }
}
