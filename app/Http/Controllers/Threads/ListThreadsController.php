<?php

namespace App\Http\Controllers\Threads;

use App\Models\User;
use App\Models\Thread;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListThreadsController extends Controller
{
    public function __invoke(Request $request, ?User $user) : View
    {
        if ($request->q) {
            $request->validate(['q' => ['string', 'min:3']]);

            $threads = Thread::search($request->q);
        } else {
            $threads = Thread::orderByLastActivity();
        }

        if ($request->filter_by) {
            if ('my_threads' === $request->filter_by && $user) {
                $threads->where('user_id', $user->id);
            } elseif ('contributed' === $request->filter_by && $user) {
                $threads->whereRelation('replies', 'user_id', $user->id);
            } elseif ('resolved' === $request->filter_by) {
                $threads->whereNotNull('resolved_by');
            } elseif ('unresolved' === $request->filter_by) {
                $threads->whereNull('resolved_by');
            } elseif ('no_reply' === $request->filter_by) {
                $threads->doesntHave('replies');
            }
        }

        return view('threads.index', [
            'q' => $request->q,
            'threads' => $threads->simplePaginate(10)->appends(['q' => $request->q]),
            'filter_by' => $request->filter_by,
        ]);
    }
}
