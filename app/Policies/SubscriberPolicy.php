<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, Subscriber $subscriber) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Subscriber $subscriber) : bool
    {
        return false;
    }

    public function delete(User $user, Subscriber $subscriber) : bool
    {
        return false;
    }

    public function restore(User $user, Subscriber $subscriber) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Subscriber $subscriber) : bool
    {
        return false;
    }
}
