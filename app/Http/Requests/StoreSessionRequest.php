<?php

namespace App\Http\Requests;

use App\Enums\TableSessionFieldStatusEnum;
use App\Enums\TableSessionFieldTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSessionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'term_id'      => 'required|exists:terms,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'duration'     => 'required|',
            'ordering'     => 'required|',
            'type'         => 'required|'. Rule::in(TableSessionFieldTypeEnum::values()),
            'start'        => 'required|date_format:H:i:s',
            'end'          => 'required|date_format:H:i:s|after:start',
            'date'         => 'required|date',
        ];
    }
}
