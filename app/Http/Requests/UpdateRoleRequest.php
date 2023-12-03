<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "id" => "required|exists:roles,id",
            "name"=>"required|min:3|unique:roles,name".
                $this->role->id,
            "permissions" => "required|array|min:1"

        ];
    }
}
