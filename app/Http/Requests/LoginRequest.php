<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'mobile'   => 'required|size:11',
            'password' => 'required',
        ];
    }
}
