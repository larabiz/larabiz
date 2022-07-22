<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $authenticated) : bool
    {
        return false;
    }

    public function view(User $authenticated, User $user) : bool
    {
        return false;
    }

    public function create(User $authenticated) : bool
    {
        return false;
    }

    public function update(User $authenticated, User $user) : bool
    {
        return false;
    }

    public function delete(User $authenticated, User $user) : bool
    {
        return false;
    }

    public function restore(User $authenticated, User $user) : bool
    {
        return false;
    }

    public function forceDelete(User $authenticated, User $user) : bool
    {
        return false;
    }
}
