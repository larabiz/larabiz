<?php

namespace App\Nova\Metrics;

abstract class Value extends \Laravel\Nova\Metrics\Value
{
    public function ranges() : array
    {
        return [
            'ALL' => __('All Time'),
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'TODAY' => __('Today'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    public function uriKey() : string
    {
        return str(static::class)
            ->classBasename()
            ->snake()
            ->slug();
    }
}
