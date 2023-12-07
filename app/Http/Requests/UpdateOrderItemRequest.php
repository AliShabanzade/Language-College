<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'book_id'  => 'required',
            'order_id' => 'required',
            'quantity' => 'required',
            'price'    => 'required',
        ];
    }
}
