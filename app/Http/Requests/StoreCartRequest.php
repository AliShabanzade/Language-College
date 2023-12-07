<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{

    public function rules(): array
    {
        return [

            'book_id' => 'required|exists:books,id', 
            'quantity' => 'required|numeric|min:1',


        ];
    }
}
