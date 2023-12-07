<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "user_id" => ['required'],
            'total'   => ['required'],
            'status'  => ['required'],

        ];
    }
}
