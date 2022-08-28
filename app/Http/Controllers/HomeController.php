<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __invoke() : View
    {
        return view('home')->with([
            'latest' => Post::query()
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->latest()
                ->limit(6)
                ->get(),
            'pageviews' => cache()->remember('pageviews', 600, fn () => $this->pageviews()),
            'visitors' => cache()->remember('visitors', 600, fn () => $this->visitors()),
            'users_count' => User::whereNotNull('email_verified_at')->count(),
        ]);
    }

    public function pageviews() : int
    {
        $lastMonth = now()->setDay(1)->setTime(0, 0, 0)->subMonth()->toDateTimeString();

        return Http::withToken(config('services.fathom.api_token'))
            ->get('https://api.usefathom.com/v1/aggregations', [
                'aggregates' => 'pageviews',
                'date_from' => $lastMonth,
                'date_grouping' => 'month',
                'entity_id' => config('services.fathom.site_id'),
                'entity' => 'pageview',
            ])
            ->throw()
            ->collect()
            ->average('pageviews');
    }

    public function visitors() : int
    {
        return Http::withToken(config('services.fathom.api_token'))
            ->get('https://api.usefathom.com/v1/aggregations', [
                'aggregates' => 'visits',
                'entity_id' => config('services.fathom.site_id'),
                'entity' => 'pageview',
            ])
            ->throw()
            ->collect()
            ->get(0)['visits'];
    }
}
