<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    protected function passwordRules() : array
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
}
