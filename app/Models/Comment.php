<?php

namespace App\Models;

use App\Models\Traits\HasRandomId;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use BelongsToUser, HasFactory, HasRandomId, SoftDeletes;

    protected $guarded = [];

    public static function booted() : void
    {
        static::addGlobalScope('author', function (Builder $query) {
            $query
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'comments.user_id')
                        ->limit(1),
                ])
                ->addSelect([
                    'user_email' => User::select('email')
                        ->whereColumn('id', 'comments.user_id')
                        ->limit(1),
                ]);
        });
    }

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
