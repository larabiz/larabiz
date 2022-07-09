<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory, SoftDeletes;

    protected $withCount = ['choices'];

    public function choices() : HasMany
    {
        return $this->hasMany(Choice::class);
    }
}
