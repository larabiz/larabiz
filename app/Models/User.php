<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function discussions() : HasMany
    {
        return $this->hasMany(Discussion::class);
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
