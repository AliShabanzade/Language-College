<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => [ "string", "min:5", "max:40"],
            'mobile' => ["numeric", "regex:(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}"],
            'company' => ["string", "min:2", "max:40"],
            'subject' => ["string", "min:4", "max:40"],
            'message' => ["string", "min:10", "max:400"],
        ];
    }
}
