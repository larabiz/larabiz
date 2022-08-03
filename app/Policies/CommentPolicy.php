<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user) : bool
    {
        return true;
    }

    public function view(User $user, Comment $comment) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return $user->hasVerifiedEmail();
    }

    public function update(User $user, Comment $comment) : bool
    {
        return false;
    }

    public function delete(User $user, Comment $comment) : bool
    {
        return $comment->user->is($user);
    }

    public function restore(User $user, Comment $comment) : bool
    {
        return false;
    }

    public function forceDelete(User $user, Comment $comment) : bool
    {
        return false;
    }
}
