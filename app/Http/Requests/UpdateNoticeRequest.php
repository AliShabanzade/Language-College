<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
{

    public function rules(): array
    {
        return [

            'translations'            => 'required|array',
            'translations.fa'         => 'required|array',
            'translations.fa.*.key'   => 'required|string',
            'translations.fa.*.value' => 'required|string',
            'translations.en'         => 'array',
            'translations.en.*.key'   => 'string',
            'translations.en.*.value' => 'string',
            'category_id'             => 'required|int|exists:categories,id',
            'extra_attributes'        => 'array',
            'media'                   => 'file'
        ];
    }
}
