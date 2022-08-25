<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\SetsStatus;
use App\Models\Traits\HasRandomId;
use Spatie\ModelStatus\HasStatuses;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use BelongsToUser, HasFactory, HasRandomId, HasStatuses, Searchable, SetsStatus, SoftDeletes;

    protected $guarded = [];

    protected $withCount = ['comments'];

    public static function booted() : void
    {
        static::addGlobalScope('published', function (Builder $query) {
            $query->currentStatus('published');
        });
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function preview() : Attribute
    {
        return Attribute::make(
            get: function () {
                $path = "previews/$this->random_id.png";

                return Storage::disk('public')->exists($path)
                    ? Storage::disk('public')->url($path)
                    : null;
            }
        );
    }

    public function readTime() : Attribute
    {
        return Attribute::make(
            get: function () {
                $words = str_word_count(strip_tags($this->content));
                $minutes = ceil($words / 200);

                return 0 === $minutes ? 1 : $minutes;
            }
        );
    }

    public function toSearchableArray() : array
    {
        return [
            'author' => $this->user->username,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
        ];
    }
}
