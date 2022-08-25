<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\PostsCount;
use App\Nova\Metrics\UsersCount;
use App\Nova\Metrics\EmailsCount;
use App\Nova\Metrics\CommentsCount;
use App\Nova\Metrics\SubscribersCount;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    public function cards() : array
    {
        return [
            new CommentsCount,
            new EmailsCount,
            new PostsCount,
            new SubscribersCount,
            new UsersCount,
        ];
    }
}
