<?php

namespace App\Models\Traits;

use App\Models\Post;
use App\Models\Status;

trait CachesCount
{
    public static function bootCachesCount() : void
    {
        static::created(fn ($model) => static::cacheCount($model));

        static::deleted(fn ($model) => static::cacheCount($model));
    }

    protected static function cacheCount($model)
    {
        if ($model instanceof Status && Post::class === $model->model_type) {
            return cache()->forever("{$model->model_type}_count", $model->model_type::count());
        }

        return cache()->forever($model::class . '_count', $model::class::count());
    }
}
