<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id'  => 'required',
            'reading_time' => 'required',
            'media'        => '',
            'translations' => 'array',
            'translations.fa.*.key' => 'required|string',
            'translations.fa.*.value' => 'required|string',
            'translations.en.*.key' => 'required|string',
            'translations.en.*.value' => 'required|string',
        ];
    }
}
