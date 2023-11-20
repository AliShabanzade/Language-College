<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'name' => ['required','string'],
            'publication' => ['required','string'],
            'user_id' => ['nullable', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
            'inventory' => ['required', 'integer'],
            'published' => ['required'],
            'price' => ['required', 'numeric'],
            'pages' => ['required', 'integer'],
            'sales' => ['required', 'integer'],
            'writer' => ['required','string'],
        ];
    }
}
