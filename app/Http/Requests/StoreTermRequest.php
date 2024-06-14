<?php

namespace App\Http\Requests;

use App\Rules\TermUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTermRequest extends FormRequest
{

    public function rules(): array
    {
        $term = $this->route('term');
        $data = [];
        $data[] = $this->input('translations.*.fa.*.value');
        $data[] = $data;
        return [
            'course_id' => ['required', 'exists:courses,id'],
            'ordering' => 'required|integer',
            'assessment' => 'required|boolean',
            'translations' => 'array',
            'translations.*.fa.*.key' => 'string',
            'translations.*.fa.*.value' => ['required', 'string', new TermUniqueRule],
            'prerequisite_id' => 'nullable|exists:terms,id'
        ];
    }
}
