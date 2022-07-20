<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Choice extends Model
{
    use HasFactory, SoftDeletes;

    protected $withCount = ['votes'];

    public function poll() : BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes() : HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
