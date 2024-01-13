<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{

    public function rules(): array
    {
        return [


            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'publication_id' => ['nullable', 'integer', 'exists:publications,id'],
            'inventory' => ['required', 'integer'],
            'published' => ['required'],
            'price' => ['required', 'numeric'],
            'pages' => ['required', 'integer'],
            'sales' => ['required', 'integer'],
            'media' => '',

            'translations' => 'array',
            'translations.*.fa.*.key' => 'string',
            'translations.*.fa.*.value' => 'string',

            'extra_attributes' => 'array',
        ];
    }
}
