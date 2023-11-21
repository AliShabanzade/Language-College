<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:categories'],
            'type' => ['required', 'string','max:255'],
            'published' => ['required'],
        ];
    }
}
