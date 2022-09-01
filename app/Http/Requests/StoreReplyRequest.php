<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'content' => ['required', 'min:3'],
        ];
    }
}
