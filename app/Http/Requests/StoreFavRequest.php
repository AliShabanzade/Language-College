<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'translations'              => 'array',
            'translations.*.fa.*.key'   => 'string',
            'translations.*.fa.*.value' => 'string',
            'media'                     => '',
        ];
    }
}
