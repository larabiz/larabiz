<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Subscription extends BaseModel
{
    use BelongsToUser;

    public function subscribable() : MorphTo
    {
        return $this->morphTo();
    }
}
