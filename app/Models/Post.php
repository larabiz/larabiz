<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use App\Models\Traits\SetsStatus;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Traits\HasRandomId;
use Spatie\ModelStatus\HasStatuses;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use BelongsToUser, HasFactory, HasRandomId, HasStatuses, InteractsWithMedia, Searchable, SetsStatus, SoftDeletes;

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

    public function readTime() : Attribute
    {
        return new Attribute(
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

    public function registerMediaCollections() : void
    {
        $this
            ->addMediaCollection('illustration')
            ->singleFile()
            ->onlyKeepLatest(1);

        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this
            ->addMediaConversion('large')
            ->fit(Manipulations::FIT_MAX, 1280, 1280);

        $this
            ->addMediaConversion('medium')
            ->fit(Manipulations::FIT_MAX, 640, 640);

        $this
            ->addMediaConversion('small')
            ->fit(Manipulations::FIT_MAX, 320, 320);

        $this
            ->addMediaConversion('thumbnail')
            ->crop(Manipulations::CROP_CENTER, 150, 150);
    }
}
