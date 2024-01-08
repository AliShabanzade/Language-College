<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'parent_id'              => ['nullable', 'exists:categories,id'],
            'type'                   => ['required', 'string', 'max:255'],
            'published'              => ['required'],
            'slug'                   => 'sometimes|string',
            'translation'            => 'array',
            'translation.fa.*.key'   => 'string|required',
            'translation.fa.*.value' => 'string|required',
            'translation.en.*.key'   => 'string',
            'translation.en.*.value' => 'string',

        ];
    }
}
