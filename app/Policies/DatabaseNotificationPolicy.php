<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Notifications\DatabaseNotification;

class DatabaseNotificationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, DatabaseNotification $databaseNotification) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, DatabaseNotification $databaseNotification) : bool
    {
        return false;
    }

    public function delete(User $user, DatabaseNotification $databaseNotification) : bool
    {
        return false;
    }

    public function restore(User $user, DatabaseNotification $databaseNotification) : bool
    {
        return false;
    }

    public function forceDelete(User $user, DatabaseNotification $databaseNotification) : bool
    {
        return false;
    }
}
