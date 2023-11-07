<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'mobile' => 'required|digits:11|regex:/09[0-9]{8}/',
        ];
    }
}
