<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
{

    public function rules(): array
    {

        return [

            'password'         => ['required',
                                   'confirmed',
                                   'min:6',
                                   'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
//            'confirm_password' => 'required|same:password',
            'name'             => 'string|max:255',
        ];
    }
}
