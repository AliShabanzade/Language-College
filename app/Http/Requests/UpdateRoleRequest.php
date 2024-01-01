<?php

namespace App\Http\Requests;

use App\Enums\PermissionEnum;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => 'required|min:3|' . Rule::unique('roles', 'name')
                    ->ignore($this->route('role'), 'id'),
            "permissions" => "nullable|array|min:1",
            "permissions.*.name" => ['string', 'distinct', Rule::in(PermissionEnum::values())],
        ];

    }
}
