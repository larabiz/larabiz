<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, Reply $reply) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Reply $reply) : bool
    {
        return false;
    }

    public function delete(User $user, Reply $reply) : bool
    {
        return false;
    }

    public function restore(User $user, Reply $reply) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Reply $reply) : bool
    {
        return false;
    }
}
