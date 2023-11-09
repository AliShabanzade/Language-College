<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ]
        ];
    }
}
