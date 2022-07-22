<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, Discussion $discussion) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Discussion $discussion) : bool
    {
        return false;
    }

    public function delete(User $user, Discussion $discussion) : bool
    {
        return false;
    }

    public function restore(User $user, Discussion $discussion) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Discussion $discussion) : bool
    {
        return false;
    }
}
