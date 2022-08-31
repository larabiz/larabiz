<?php

namespace App\Actions\Fortify;

use App\Traits\ValidatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use ValidatesUsers;

    /**
     * @param mixed $user
     */
    public function update($user, array $input) : void
    {
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->creationRules()['password'],
        ])->after(function ($validator) use ($user, $input) {
            if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $user->forceFill(['password' => Hash::make($input['password'])])->save();
    }
}
