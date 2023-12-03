<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'extra_attributes'        => 'array',
        ];
    }
}
