<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function scopeVerified(Builder $query) : void
    {
        $query->whereNotNull('email_verified_at');
    }

    public function scopeMaster(Builder $query) : void
    {
        $query->where('email', 'benjamincrozat@me.com');
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function subscriptions() : HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribeTo(Post $post)
    {
        return $this->subscriptions()->firstOrCreate([
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);
    }

    public function subscribedTo(Post $post) : bool
    {
        return $this->subscriptions()->where([
            ['user_id', $this->id],
            ['subscribable_type', $post->getMorphClass()],
            ['subscribable_id', $post->id],
        ])->exists();
    }

    public function unsubscribeFrom(Post $post) : mixed
    {
        return $this->subscriptions()->where([
            ['subscribable_type', $post->getMorphClass()],
            ['subscribable_id', $post->id],
        ])->delete();
    }
}
