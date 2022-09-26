<?php

namespace App\Models\Traits;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ManagesSubscriptions
{
    public function subscriptions() : HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribeTo(Model $model)
    {
        return $this->subscriptions()->firstOrCreate([
            'subscribable_type' => $model->getMorphClass(),
            'subscribable_id' => $model->id,
        ]);
    }

    public function subscribedTo(Model $model) : bool
    {
        return $this->subscriptions()->where([
            ['user_id', $this->id],
            ['subscribable_type', $model->getMorphClass()],
            ['subscribable_id', $model->id],
        ])->exists();
    }

    public function unsubscribeFrom(Model $model) : mixed
    {
        return $this->subscriptions()->where([
            ['subscribable_type', $model->getMorphClass()],
            ['subscribable_id', $model->id],
        ])->delete();
    }
}
