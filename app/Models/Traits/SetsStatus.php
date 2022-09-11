<?php

namespace App\Models\Traits;

use Spatie\ModelStatus\HasStatuses;

trait SetsStatus
{
    public static function bootSetsStatus() : void
    {
        // Every time a model using statuses is created without one, we set it as <draft class=""></draft>
        static::saved(function ($model) {
            if (in_array(HasStatuses::class, class_uses_recursive($model::class))
                && empty($model->status)) {
                $model->setStatus('draft');
            }
        });
    }
}
