<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * @param mixed $user
     */
    public function update($user, array $input) : void
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'min:3', 'max:255'],
            'github' => ['nullable', 'url', 'regex:/^https?:\/\/github.com\//'],
            'linkedin' => ['nullable', 'url', 'regex:/^https?:\/\/www\.linkedin.com\/in\//'],
            'biography' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ])->validateWithBag('updateProfileInformation');

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
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
