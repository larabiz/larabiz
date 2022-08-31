<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Traits\ValidatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use ValidatesUsers;

    public function create(array $input) : User
    {
        Validator::make(
            $input,
            $this->creationRules(),
            $this->messages()
        )->validate();

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
