<?php

namespace App\Http\Controllers\Threads;

use App\Models\Thread;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowThreadController extends Controller
{
    public function __construct()
    {
        if (app()->isProduction()) {
            $this->middleware('master');
        }
    }

    public function __invoke(string $randomId, string $slug) : View
    {
        $thread = Thread::whereRandomId($randomId)->firstOrFail();

        if ($slug !== $thread->slug) {
            return to_route('threads.show', [$randomId, $thread->slug], 301);
        }

        return view('threads.show', compact('thread') + [
            'replies' => $thread->replies()->simplePaginate(10),
        ]);
    }
}
