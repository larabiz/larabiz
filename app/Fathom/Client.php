<?php

namespace App\Fathom;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class Client
{
    public function __construct(
        protected Factory $http,
        protected string $apiToken,
        protected string $siteId,
    ) {
    }

    public function pageviewsCountFromLastThirtyDays() : int
    {
        return $this
            ->request()
            ->get('https://api.usefathom.com/v1/aggregations', [
                'aggregates' => 'pageviews',
                'date_from' => now()->subDays(30)->toDateTimeString(),
                'entity_id' => $this->siteId,
                'entity' => 'pageview',
            ])
            ->throw()
            ->json()[0]['pageviews'];
    }

    public function visitsCountFromLastThirtyDays() : int
    {
        return $this
            ->request()
            ->get('https://api.usefathom.com/v1/aggregations', [
                'aggregates' => 'visits',
                'date_from' => now()->subDays(30)->toDateTimeString(),
                'entity_id' => $this->siteId,
                'entity' => 'pageview',
            ])
            ->throw()
            ->json()[0]['visits'];
    }

    protected function request() : PendingRequest
    {
        return $this->http->withToken($this->apiToken);
    }
}
