<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input) : User
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'unique:users,username', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
        ], [
            'username.required' => "Un nom d'utilisateur est requis.",
            'username.unique' => "Ce nom d'utilisateur est déjà pris.",
            'username.min' => "Votre nom d'utilisateur est trop court.",
            'username.max' => "Votre nom d'utilisateur est trop long.",
            'email.required' => 'Une adresse e-mail est requise.',
            'email.email' => 'Le format de votre adresse e-mail est invalide.',
            'email.max' => 'Votre adresse e-mail est trop longue.',
            'email.unique' => 'Cette adresse e-mail ne peut être utilisée.',
        ])->validate();

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
