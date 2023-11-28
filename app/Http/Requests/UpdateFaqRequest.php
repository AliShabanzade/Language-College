<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'question'    => ['required'],
            'answer'      => ['required'],
            'type'        => ['required'],
            'category_id' => ['required'],

        ];
    }
}
