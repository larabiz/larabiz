<?php

namespace App\Models\Traits;

use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ManagesSubscriptions
{
    public function subscriptions() : HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribeTo(Post $post)
    {
        return $this->subscriptions()->firstOrCreate([
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);
    }

    public function subscribedTo(Post $post) : bool
    {
        return $this->subscriptions()->where([
            ['user_id', $this->id],
            ['subscribable_type', $post->getMorphClass()],
            ['subscribable_id', $post->id],
        ])->exists();
    }

    public function unsubscribeFrom(Post $post) : mixed
    {
        return $this->subscriptions()->where([
            ['subscribable_type', $post->getMorphClass()],
            ['subscribable_id', $post->id],
        ])->delete();
    }
}
