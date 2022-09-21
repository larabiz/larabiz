<?php

namespace App\Http\Controllers\Threads;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Requests\StoreThreadRequest;

class StoreThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        if (app()->isProduction()) {
            $this->middleware('master');
        }

        $this->middleware(ProtectAgainstSpam::class);
    }

    public function __invoke(StoreThreadRequest $request, User $user) : RedirectResponse
    {
        $thread = $user->threads()->create(
            $request->validated() + ['last_activity_at' => now()]
        );

        return to_route('threads.show', [$thread->random_id, $thread->slug])->with('status', 'Votre discussion a bien été créée.');
    }
}
