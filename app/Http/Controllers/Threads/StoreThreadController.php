<?php

namespace App\Http\Controllers\Threads;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreThreadRequest;

class StoreThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(StoreThreadRequest $request, User $user) : RedirectResponse
    {
        $thread = $user->threads()->create(
            $request->validated() + ['last_activity_at' => now()]
        );

        return to_route('threads.show', [$thread->random_id, $thread->slug])->with('status', 'Votre discussion a bien été créée.');
    }
}
