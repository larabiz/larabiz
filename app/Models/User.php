<?php

namespace App\Models;

use App\Models\Traits\CachesCount;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\ManagesSubscriptions;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use CachesCount, HasFactory, ManagesSubscriptions, Notifiable, SoftDeletes;

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
        $query->where('email', config('app.master_email'));
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function threads() : HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function avatarUrl() : Attribute
    {
        return Attribute::make(fn () => 'https://www.gravatar.com/avatar/' . md5($this->email));
    }

    public function name() : Attribute
    {
        return Attribute::make(fn () => $this->username);
    }

    public function getMorphClass() : string
    {
        return static::class;
    }

    public function getFilamentName() : string
    {
        return $this->username;
    }

    public function canAccessFilament() : bool
    {
        return $this->email === config('app.master_email');
    }
}
