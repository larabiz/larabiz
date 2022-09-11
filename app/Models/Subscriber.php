<?php

namespace App\Models;

use App\Models\Traits\CachesCount;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class Subscriber extends BaseModel
{
    use CachesCount, Notifiable;

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    public function scopeConfirmed(Builder $query) : void
    {
        $query->whereNotNull('confirmed_at');
    }
}
