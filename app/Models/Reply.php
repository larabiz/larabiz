<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    public function discussion() : BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }
}
