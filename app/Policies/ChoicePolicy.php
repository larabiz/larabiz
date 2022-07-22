<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Choice;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, Choice $choice) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Choice $choice) : bool
    {
        return false;
    }

    public function delete(User $user, Choice $choice) : bool
    {
        return false;
    }

    public function restore(User $user, Choice $choice) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Choice $choice) : bool
    {
        return false;
    }
}
