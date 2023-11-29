<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                //'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ]
        ];
    }
}
