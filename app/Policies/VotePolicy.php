<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Auth\Access\HandlesAuthorization;

class VotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, Vote $vote) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Vote $vote) : bool
    {
        return false;
    }

    public function delete(User $user, Vote $vote) : bool
    {
        return false;
    }

    public function restore(User $user, Vote $vote) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Vote $vote) : bool
    {
        return false;
    }
}
