<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ExperienceGain;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperienceGainPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) : bool
    {
        return false;
    }

    public function view(User $user, ExperienceGain $experienceGain) : bool
    {
        return false;
    }

    public function create(User $user) : bool
    {
        return false;
    }

    public function update(User $user, ExperienceGain $experienceGain) : bool
    {
        return false;
    }

    public function delete(User $user, ExperienceGain $experienceGain) : bool
    {
        return false;
    }

    public function restore(User $user, ExperienceGain $experienceGain) : bool
    {
        return false;
    }

    public function forceDelete(User $user, ExperienceGain $experienceGain) : bool
    {
        return false;
    }
}
