<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:categories'],
            'type' => ['required', 'string','max:255'],
            'published' => ['required'],
            'slug'=>'sometimes|string',
            'translation' =>'array',
            'translation.key'=>'string|required',
            'translation.values.fa.value'=>'string|required',
            'translation.values.en.value'=>'string|required',

        ];
    }
}
