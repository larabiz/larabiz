<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function booted() : void
    {
        static::addGlobalScope('user', function (Builder $query) {
            // $query
            //     ->addSelect([
            //         'username' => User::select('username')
            //             ->whereColumn('id', 'replies.user_id')
            //             ->limit(1),
            //     ])
            //     ->addSelect([
            //         'user_email' => User::select('email')
            //             ->whereColumn('id', 'replies.user_id')
            //             ->limit(1),
            //     ]);
        });
    }

    public function thread() : BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
}
