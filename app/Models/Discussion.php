<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $withCount = ['replies'];

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
