<?php

namespace App\Http\Requests;

use App\Enums\CategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:categories'],
            'type' => ['required', Rule::in(array_column(CategoryEnum::cases(),'value'))],
            'published' => ['required'],
        ];
    }
}
