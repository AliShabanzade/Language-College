<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name"        => "required|min:3|unique:roles,name," . $this->input('id'),
            "permissions" => "nullable|array|min:1"
        ];

    }
}
