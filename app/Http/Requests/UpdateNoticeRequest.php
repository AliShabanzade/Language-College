<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'title'       => 'string|required',
            'description' => 'string|required',
            'published'   => 'boolean|required',
        ];
    }
}
