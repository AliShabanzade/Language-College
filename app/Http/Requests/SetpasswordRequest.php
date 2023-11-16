<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetpasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'name' => 'string|max:255',
        ];
    }
}
