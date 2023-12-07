<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemRequest extends FormRequest
{

    public function rules(): array
    {
        return [

            'book_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }
}
