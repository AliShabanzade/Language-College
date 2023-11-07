<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'mobile_number' => [
                'required',
                'size:11',
                Rule::unique('users', 'mobile_number')
                    ->ignore($this->user->id)
            ],
            'email'         => [
                'sometimes',
                Rule::unique('users', 'email')->ignore($this->user->id)
            ],
        ];
    }
}
