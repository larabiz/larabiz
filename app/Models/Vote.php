<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    protected $guarded = [];

    public function choice() : BelongsTo
    {
        return $this->belongsTo(Choice::class);
    }
}
