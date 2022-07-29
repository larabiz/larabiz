<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function booted() : void
    {
        static::creating(function (self $comment) {
            $comment->random_id = Str::random(6);
        });
    }

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function comment() : BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
