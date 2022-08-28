<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'content' => ['required', 'string', 'min:3'],
            'subscribe' => ['nullable', 'boolean'],
        ];
    }

    public function messages() : array
    {
        return [
            'content.required' => "N'avez-vous pas oublié de taper votre commentaire ?",
            'content.min' => 'Votre commentaire est bien trop court !',
        ];
    }
}
