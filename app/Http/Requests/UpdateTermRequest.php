<?php

namespace App\Http\Requests;

use App\Rules\TermUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTermRequest extends FormRequest
{

    public function rules(): array
    {
        $term = $this->route('term');
        return [
            'course_id'                 => ['required', 'exists:courses,id'],
            'ordering'                  => 'required|integer',
            'assessment'                => 'required|boolean',
            'translations'              => 'array',
            'translations.*.fa.*.key'   => 'string',
            'translations.*.fa.*.value' => ['required','string', (new TermUniqueRule())->setData($term)],
            'prerequisite_id'              => 'nullable|string'
        ];
    }
}
