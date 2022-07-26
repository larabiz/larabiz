<?php

namespace App\Models;

use Laravel\Nova\Nova;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use BelongsToUser, HasFactory, InteractsWithMedia, SoftDeletes;

    protected $guarded = [];

    protected $withCount = ['comments'];

    public static function booted() : void
    {
        static::creating(function (self $post) {
            $post->random_id = Str::random(6);
        });

        static::saved(function (self $post) {
            Nova::serving(function () use ($post) {
                Str::marxdown($post->content);
            });
        });

        static::addGlobalScope('published', function (Builder $builder) {
            if (! auth()->check()) {
                $builder->where('is_draft', false);
            }
        });
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
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
