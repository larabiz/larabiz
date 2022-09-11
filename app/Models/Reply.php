<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends BaseModel
{
    use BelongsToUser;

    public function thread() : BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
}
