<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'string',
            'mobile_number' => $this->method()===self::METHOD_PATCH ? 'required|size:11|string|unique:users,mobile_number,'.
                    $this->user->id :'required|size:11|string|unique:users,mobile_number',




            'email' => $this->method()===self::METHOD_PATCH ? 'string|email|unique:users,email,'.
                $this->user->id :'string|email|unique:users,email',

//
        ];
    }
}
