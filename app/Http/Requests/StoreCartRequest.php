<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'user_id'  => ['required'],
            'book_id' => ['required'],
        ];
    }
}
