<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name'   => 'string|max:255',
            'mobile' => $this->method() === self::METHOD_PATCH ? 'required|size:11|string|unique:users,mobile,' .
                $this->user->id : 'required|size:11|string|unique:users,mobile',
            'email'  => $this->method() === self::METHOD_PATCH ? 'string|email|unique:users,email,' .
                $this->user->id : 'string|email|unique:users,email',
        ];
    }
}
