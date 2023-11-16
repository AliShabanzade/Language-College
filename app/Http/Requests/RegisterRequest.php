<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'mobile' => 'required|unique:users,mobile|digits:11|regex:/09[0-9]{8}/'
        ];
    }
}
