<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'mobile' => 'required|digits:11|regex:/09[0-9]{8}/',
            'code' => 'required|digits:4',
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
