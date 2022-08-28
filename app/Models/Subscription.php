<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subscriptionable() : MorphTo
    {
        return $this->morphTo();
    }
}
