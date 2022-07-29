<?php

namespace App\Models;

use Laravel\Nova\Auth\Impersonatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Impersonatable, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeMaster(Builder $query) : void
    {
        $query->where('email', 'benjamincrozat@me.com');
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function discussions() : HasMany
    {
        return $this->hasMany(Discussion::class);
    }

    public function experienceGains() : HasMany
    {
        return $this->hasMany(ExperienceGain::class);
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function sumExperienceGainsPoints() : int
    {
        return $this->experienceGains()->sum('points');
    }
}
