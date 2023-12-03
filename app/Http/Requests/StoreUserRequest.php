<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name'   => 'string|max:255',
            'mobile' => 'required|size:11|string|unique:users,mobile',
            'email'  => 'nullable|string|email|unique:users,email',
        ];
    }
}
