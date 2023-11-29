<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeRequest extends FormRequest
{

    public function rules(): array
    {
        return [

            'published'   => 'boolean|required',
            'media'       => ''
        ];
    }
}
