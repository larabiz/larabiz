<?php

namespace App\Http\Controllers\Replies;

use App\Models\User;
use App\Models\Thread;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreReplyRequest;

class StoreReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        if (app()->isProduction()) {
            $this->middleware('master');
        }
    }

    public function __invoke(StoreReplyRequest $request, User $user, Thread $thread) : RedirectResponse
    {
        $user->replies()->create(
            $request->validated() + ['thread_id' => $thread->id]
        );

        return to_route('threads.show', [$thread->random_id, $thread->slug])->with('status', 'Votre réponse a bien été ajoutée.');
    }
}
