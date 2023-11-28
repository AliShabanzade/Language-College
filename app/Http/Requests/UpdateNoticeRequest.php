<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
{

    public function rules(): array
    {
        return [

            'published'   => 'boolean|required',
            'media'       => ''
        ];
    }
}
