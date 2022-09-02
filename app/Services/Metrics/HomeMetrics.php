<?php

namespace App\Services\Metrics;

use App\Models\Post;
use App\Models\User;
use NumberFormatter;
use App\Models\Subscriber;

class HomeMetrics
{
    public $formatter;

    public function __construct()
    {
        $this->formatter = new NumberFormatter('fr_FR', NumberFormatter::DECIMAL);
    }

    public function pageviews(): string|false
    {
        return $this->formatter->format(cache()->get('pageviews'));
    }

    public function visits(): string|false
    {
        return $this->formatter->format(cache()->get('visits'));
    }

    public function users(): string|false
    {
        return $this->formatter->format(User::whereNotNull('email_verified_at')->count());
    }

    public function subscribers(): string|false
    {
        return $this->formatter->format(Subscriber::confirmed()->count());
    }

    public function posts(): string|false
    {
        return $this->formatter->format(Post::count());
    }
}
