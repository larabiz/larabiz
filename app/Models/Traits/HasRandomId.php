<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasRandomId
{
    public static function bootHasRandomId() : void
    {
        static::creating(function ($model) {
            $model->random_id = Str::random(6);
        });
    }
}
