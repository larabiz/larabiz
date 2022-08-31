<?php

namespace App\Actions\Fortify;

use App\Traits\ValidatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use ValidatesUsers;

    /**
     * @param mixed $user
     */
    public function reset($user, array $input) : void
    {
        Validator::make($input, [
            'password' => $this->creationRules()['password'],
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
