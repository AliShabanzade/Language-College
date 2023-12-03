<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
           "name"=> "required|min:3|unique:roles,name",
           "permissions" => "required|array|min:1"
        ];
    }
}
