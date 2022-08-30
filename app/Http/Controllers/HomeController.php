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
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->latest()
                ->limit(4)
                ->get(),
            'pageviews' => $formatter->format(cache()->get('pageviews')),
            'visits' => $formatter->format(cache()->get('visits')),
            'users_count' => $formatter->format(User::whereNotNull('email_verified_at')->count()),
            'subscribers_count' => $formatter->format(Subscriber::confirmed()->count()),
            'posts_count' => $formatter->format(Post::count()),
        ]);
    }
}
