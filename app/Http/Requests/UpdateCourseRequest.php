<?php

namespace App\Http\Requests;

use App\Enums\TableCourseFieldTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'translations'                                            => 'required|array',
            'translations.*' . app()->getLocale() . '*.key'           => 'required|string',
            'translations.*' . app()->getLocale() . '*.value'         => 'required|string',
            'type'                                                   => 'required|string|' . Rule::in(TableCourseFieldTypeEnum::values()),
            'published'                                              => 'required|boolean',
            'media'                                             ,
        ];
    }
}
