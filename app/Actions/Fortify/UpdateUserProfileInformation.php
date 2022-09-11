<?php

namespace App\Actions\Fortify;

use App\Traits\ValidatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use ValidatesUsers;

    /**
     * @param mixed $user
     */
    public function update($user, array $input) : void
    {
        Validator::make($input, $this->updateRules($user, $input), $this->messages())
            ->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'username' => $input['username'],
                'github' => $input['github'],
                'linkedin' => $input['linkedin'],
                'biography' => $input['biography'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * @param mixed $user
     */
    protected function updateVerifiedUser($user, array $input) : void
    {
        $user->forceFill([
            'username' => $input['username'],
            'github' => $input['github'],
            'linkedin' => $input['linkedin'],
            'biography' => $input['biography'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
