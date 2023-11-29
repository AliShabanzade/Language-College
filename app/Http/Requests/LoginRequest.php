<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function rules(): array
    {
//       dd($this->request->all());

        return [
            'mobile'   => 'required|size:11',
            'password' => 'required',
        ];
    }
}
