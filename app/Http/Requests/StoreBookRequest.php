<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{

    public function rules(): array
    {

        return [

            'user_id'     => ['nullable', 'integer', 'exists::users,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'inventory'   => ['required', 'integer'],
            'published'   => ['required'],
            'price'       => ['required',],
            'pages'       => ['required', 'integer'],
            'media'       => '',
            'publication_id'=>['nullable', 'integer','exists:publications,id'],
            'translations'            => 'array',
            'translations.*.fa.*.key'   => 'string',
            'translations.*.fa.*.value' => 'string',

            'extra_attributes'        => 'array',
        ];
    }
}
