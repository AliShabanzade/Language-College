<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'name' => ['required'],
            'slug' => ['required','string'],
            'publication' => ['required'],
            'user_id' => ['nullable', 'integer','exists:users,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'inventory' => ['required', 'integer'],
            'published' => ['required'],
            'price' => ['required', 'numeric'],
            'pages' => ['required', 'integer'],
            'sales' => ['required', 'integer'],
            'writer' => ['required'],
        ];
    }
}
