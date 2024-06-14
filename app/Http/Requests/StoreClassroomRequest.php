<?php

namespace App\Http\Requests;

use App\Enums\TableClassroomFieldTypeEnum;
use App\Enums\TableUserFieldGenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClassroomRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'course_id'                 => 'nullable|exists:courses,id',
            'teacher_id'                => 'required|exists:users,id',
            'classroom_gender'          => 'required|string|'. Rule::in(TableUserFieldGenderEnum::values()),
            'published'                 => 'required|',
            'type'                      => ['required',Rule::in(TableClassroomFieldTypeEnum::values())],
            'college_id'                => 'required|exists:colleges,id',
            'term_id'                   => 'nullable|exists:terms,id',
            'term_date_id'              => 'required|exists:term_dates,id',
            'start'                     => 'required|date',
            'end'                       => 'required|date',
            'capacity'                  => 'required|integer',
            'translations'              => 'array',
            'translations.*.fa.*.key'   => 'string',
            'translations.*.fa.*.value' => 'string',
            'extra_attributes'          => 'array',
            'sort'                      => 'required',

        ];
    }
}
