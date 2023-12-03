<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property User $user
 */
class UpdateUserRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'name'   => 'string|max:255',
            'mobile' => 'required|size:11|string|unique:users,mobile,' . $this->user->id,
            'email'  => 'string|email|unique:users,email,' . $this->user->id,
            'password' => [
        'required',
        'confirmed',
        'min:6',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
    ],
        ];
    }
}
