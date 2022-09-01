<?php

namespace App\Models;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Laravel\Scout\Searchable;
use App\Models\Traits\SetsStatus;
use App\Models\Traits\HasRandomId;
use Illuminate\Support\Collection;
use Spatie\ModelStatus\HasStatuses;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements Feedable
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

    public function scopeWithUsername(Builder $query) : void
    {
        $query->addSelect([
            'username' => User::select('username')
                ->whereColumn('id', 'posts.user_id')
                ->limit(1),
        ]);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function subscriptions() : MorphMany
    {
        return $this->morphMany(Subscription::class, 'subscribable');
    }

    public function previewUrl() : Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url($this->preview)
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

    public function toFeedItem() : FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->excerpt,
            'updated' => $this->updated_at,
            'link' => route('posts.show', [$this->random_id, $this->slug]),
            'authorName' => $this->username,
        ]);
    }

    public static function getFeedItems() : Collection
    {
        return self::withUsername()->latest()->limit(10)->get();
    }
}
