<?php

namespace App\Models\Traits;

use Laravel\Nova\Nova;
use Laravel\Nova\Http\Requests\NovaRequest;

trait SetsStatus
{
    public static function bootSetsStatus() : void
    {
        static::saved(function ($model) {
            Nova::whenServing(function (NovaRequest $request) use ($model) {
                if (! empty($request->status) && $model->status !== $request->status) {
                    $model->setStatus($request->status);
                }
            }, function () use ($model) {
                if (empty($model->status)) {
                    $model->setStatus('draft');
                }
            });
        });
    }
}
