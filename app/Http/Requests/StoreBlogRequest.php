<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id'             => 'required|exists:categories,id',
            'reading_time'            => 'required|numeric|min:1',
            //            'media'                   => '', dont need for files
            'translations'            => 'array',
            'translations.fa.*.key'   => 'required|string',
            'translations.fa.*.value' => 'required|string',
        ];
    }
}
