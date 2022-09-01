<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\HasRandomId;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use BelongsToUser, HasFactory, HasRandomId, Searchable, SoftDeletes;

    protected $casts = ['last_reply_created_at' => 'datetime'];

    protected $guarded = [];

    protected $withCount = ['replies'];

    public static function booted() : void
    {
        static::creating(function (self $model) {
            $model->slug = str($model->title)->slug();
        });

        static::addGlobalScope('user', function (Builder $query) {
            $query
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'threads.user_id')
                        ->limit(1),
                ])
                ->addSelect([
                    'user_email' => User::select('email')
                        ->whereColumn('id', 'threads.user_id')
                        ->limit(1),
                ]);
        });

        static::addGlobalScope('last_reply', function (Builder $query) {
            $query
                ->addSelect([
                    'last_reply_username' => Reply::select('username')
                        ->join('users', 'users.id', '=', 'replies.user_id')
                        ->whereColumn('thread_id', 'threads.id')
                        ->limit(1),
                ])
                ->addSelect([
                    'last_reply_created_at' => Reply::select('created_at')
                        ->whereColumn('thread_id', 'threads.id')
                        ->latest()
                        ->limit(1),
                ]);
        });
    }

    public function scopeOrderByLastActivity(Builder $query)
    {
        $query->orderBy('last_activity_at', 'desc');
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsResolved(Reply $reply)
    {
        return tap($this)->update(['resolved_by' => $reply->id]);
    }

    public function toSearchableArray() : array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
