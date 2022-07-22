<?php

namespace App\Policies;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, Poll $poll) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Poll $poll) : bool
    {
        return false;
    }

    public function delete(User $user, Poll $poll) : bool
    {
        return false;
    }

    public function restore(User $user, Poll $poll) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Poll $poll) : bool
    {
        return false;
    }
}
