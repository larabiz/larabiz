<?php

namespace App\Models;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\ModelStatus\Status;
use App\Models\Traits\HasRandomId;
use Illuminate\Support\Collection;
use Spatie\ModelStatus\HasStatuses;
use App\Models\Traits\BelongsToUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends BaseModel implements Feedable
{
    use BelongsToUser, HasRandomId, HasStatuses, Searchable;

    protected $casts = [
        'latest_status_created_at' => 'datetime',
    ];

    protected $withCount = ['comments'];

    public static function booted() : void
    {
        static::addGlobalScope('published', function (Builder $query) {
            $query->currentStatus('published');
        });

        static::addGlobalScope('author', function (Builder $query) {
            $query
                ->addSelect([
                    'username' => User::select('username')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->addSelect([
                    'user_email' => User::select('email')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ])
                ->addSelect([
                    'user_biography' => User::select('biography')
                        ->whereColumn('id', 'posts.user_id')
                        ->limit(1),
                ]);
        });

        static::addGlobalScope('status', function (Builder $query) {
            $query
                ->addSelect([
                    'latest_status' => Status::select('name')
                        ->whereColumn('id', 'statuses.model_id')
                        ->limit(1),
                ])
                ->addSelect([
                    'latest_status_created_at' => Status::select('created_at')
                        ->whereColumn('id', 'statuses.model_id')
                        ->limit(1),
                ]);
        });
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

    public function tableOfContents() : Attribute
    {
        return Attribute::make(
            get: function () {
                preg_match_all('/(#{1,6}) (.*)/', $this->content, $headings);

                $hierarchy = [];

                for ($i = 0; $i < count($headings[0]); ++$i) {
                    $title = html_entity_decode(strip_tags(Str::marxdown($headings[2][$i])));
                    $level = strlen($headings[1][$i]);

                    $hierarchy[] = [
                        'id' => Str::slug($title),
                        'title' => $title,
                        'level' => $level,
                    ];
                }

                return $hierarchy;
            }
        );
    }

    public function toSearchableArray() : array
    {
        return [
            'username' => $this->user->username,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
        ];
    }

    public function toFeedItem() : FeedItem
    {
        return FeedItem::create([
            'id' => $this->random_id,
            'title' => $this->title,
            'summary' => Str::marxdown($this->content),
            'updated' => $this->updated_at,
            'link' => route('posts.show', [$this->random_id, $this->slug]),
            'authorName' => $this->username,
        ]);
    }

    public static function getFeedItems() : Collection
    {
        return self::latest()->limit(10)->get();
    }
}
