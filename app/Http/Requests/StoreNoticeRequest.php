<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'published'                 => 'boolean|required',
            'translations'              => 'required|array',
            'translations.fa'           => 'required|array',
            'translations.*.fa.*.key'   => 'required|string',
            'translations.*.fa.*.value' => 'required|string',
            'translations.en'           => 'array',
            'translations.*.en.*.key'   => 'string',
            'translations.*.en.*.value' => 'string',
            'category_id'               => 'required|int|exists:categories,id',
            'media'                     => ''
        ];
    }
}
