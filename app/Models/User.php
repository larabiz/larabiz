<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\ManagesSubscriptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, ManagesSubscriptions, Notifiable, SoftDeletes;

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
}
