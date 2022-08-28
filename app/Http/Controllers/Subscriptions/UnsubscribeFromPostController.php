<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UnsubscribeFromPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Post $post) : RedirectResponse
    {
        $post->subscriptions()->where([
            ['user_id', auth()->id()],
            ['subscribable_type', $post->getMorphClass()],
            ['subscribable_id', $post->id],
        ])->delete();

        return back()->with('status', 'Vous ne recevrez plus de notifications en rapport avec cet article.');
    }
}
