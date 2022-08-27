<?php

namespace App\Models;

use App\Models\Traits\HasRandomId;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use BelongsToUser, HasFactory, HasRandomId, SoftDeletes;

    protected $guarded = [];

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
