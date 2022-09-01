<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules() : array
    {
        return ['q' => ['string', 'min:3']];
    }
}
