<?php

namespace App\Models;

use App\Models\Traits\CachesCount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use CachesCount, HasFactory, Notifiable, SoftDeletes;

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    protected $guarded = [];

    public function scopeConfirmed(Builder $query) : void
    {
        $query->whereNotNull('confirmed_at');
    }
}
