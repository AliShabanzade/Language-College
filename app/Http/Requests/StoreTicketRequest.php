<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', "string", "min:5", "max:40"],
            'mobile' => ['required', "numeric", "regex:(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}"],
            'company' => ['nullable', "string", "min:2", "max:40"],
            'subject' => ['required', "string", "min:4", "max:40"],
            'message' => ['required', "string", "min:10", "max:400"],
        ];
    }
}
