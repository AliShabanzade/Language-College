<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOpinionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'      => ['required'],
            'body'       => ['required'],
            'deleted_at' => ['nullable', 'date'],
        ];
    }
}
