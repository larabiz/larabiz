<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user) : bool
    {
        return true;
    }

    public function view(User $user, Post $post) : bool
    {
        return true;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, Post $post) : bool
    {
        return $post->user->is($user);
    }

    public function delete(User $user, Post $post) : bool
    {
        return false;
    }

    public function restore(User $user, Post $post) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Post $post) : bool
    {
        return false;
    }
}
