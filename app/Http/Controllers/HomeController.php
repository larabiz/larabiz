<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use NumberFormatter;
use Illuminate\View\View;
use App\Models\Subscriber;

class HomeController extends Controller
{
    public function __invoke() : View
    {
        $formatter = new NumberFormatter('fr_FR', NumberFormatter::DECIMAL);

        return view('home')->with([
            'latest' => Post::query()
                ->latest()
                ->limit(6)
                ->get(),
            'pageviews' => $formatter->format(cache()->get('pageviews')),
            'visits' => $formatter->format(cache()->get('visits')),
            'users_count' => $formatter->format(cache()->get(User::class . '_count')),
            'subscribers_count' => $formatter->format(cache()->get(Subscriber::class . '_count')),
            'posts_count' => $formatter->format(cache()->get(Post::class . '_count')),
        ]);
    }
}
