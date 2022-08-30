<?php

namespace App\Models\Traits;

trait SetsStatus
{
    public static function bootSetsStatus() : void
    {
        static::saved(function ($model) {
            if (empty($model->status)) {
                $model->setStatus('draft');
            }
        });
    }
}
