<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\PasswordValidationRules;

trait ValidatesUsers
{
    use PasswordValidationRules;

    public function creationRules() : array
    {
        return [
            'username' => ['required', 'string', 'unique:users,username', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
        ];
    }

    public function updateRules(User $user, array $input) : array
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'github' => ['nullable', Rule::when(! empty($input['github']), 'regex:/^https?:\/\/github.com\//')],
            'linkedin' => ['nullable', Rule::when(! empty($input['linkedin']), 'regex:/^https?:\/\/(www\.)?linkedin.com\/in\//')],
            'biography' => ['nullable', 'string', 'min:3', 'max:255'],
        ];
    }

    public function messages() : array
    {
        return [
            'username.required' => "Un nom d'utilisateur est requis.",
            'username.unique' => "Ce nom d'utilisateur est déjà pris.",
            'username.min' => "Votre nom d'utilisateur est trop court.",
            'username.max' => "Votre nom d'utilisateur est trop long.",
            'biography.min' => 'Votre biographie est trop courte.',
            'biography.max' => 'Votre biographie est trop longue.',
            'github.regex' => "L'URL de votre GitHub est invalide.",
            'linkedin.regex' => "L'URL de votre LinkedIn est invalide.",
            'email.required' => 'Une adresse e-mail est requise.',
            'email.email' => 'Le format de votre adresse e-mail est invalide.',
            'email.max' => 'Votre adresse e-mail est trop longue.',
            'email.unique' => 'Cette adresse e-mail ne peut être utilisée.',
        ];
    }
}
