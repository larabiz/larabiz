<?php

namespace App\Http\Controllers;

use App\Contracts\PostRepositoryInterface;
use App\Services\Metrics\HomeMetrics;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(PostRepositoryInterface $postRepository, HomeMetrics $metrics) : View
    {
        return view('home', [
            'latest' => $postRepository->latest(),
            'pageviews' => $metrics->pageviews(),
            'visits' => $metrics->visits(),
            'users_count' => $metrics->users(),
            'subscribers_count' => $metrics->subscribers(),
            'posts_count' => $metrics->posts(),
        ]);
    }
}
