<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExperienceGain extends Model
{
    use BelongsToUser, HasFactory, SoftDeletes;

    protected $guarded = [];

    public function title() : Attribute
    {
        return new Attribute(
            get: fn () => "+{$this->points} points pour {$this->user->username}"
        );
    }
}
