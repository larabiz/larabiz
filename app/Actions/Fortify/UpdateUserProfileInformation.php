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
            'username' => ['required', 'string', Rule::unique('users')->ignore($user->id), 'min:3', 'max:255'],
            'github' => ['nullable', Rule::when(! empty($input['github']), 'regex:/^https?:\/\/github.com\//')],
            'linkedin' => ['nullable', Rule::when(! empty($input['linkedin']), 'regex:/^https?:\/\/(www\.)?linkedin.com\/in\//')],
            'biography' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ], [
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
