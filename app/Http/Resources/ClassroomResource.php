<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'college'      => $this->whenLoaded('college', fn() => CollegeResource::make($this->college)),
            'course'       => $this->whenLoaded('course', fn() => CourseResource::make($this->course)),
            'teacher'      => $this->whenLoaded('user', fn() => UserResource::make($this->teacher)),
            'term'         => $this->whenLoaded('term', fn() => TermResource::make($this->term)),
            'term_date'    => $this->whenLoaded('term_date', fn() => TermDateResource::make($this->term_date)),
            'name'         => [
                'title' => __('classroom.name'),
                'value' => $this->whenLoaded('translations',
                    GetTranslationAction::run($this->resource, 'name')),
            ],
            'description'  => [
                'title' => __('classroom.description'),
                'value' => $this->whenLoaded('translations',
                    GetTranslationAction::run($this->resource, 'description'))
            ],
            'start'        => $this->start,
            'end'          => $this->end,
            'capacity'     => $this->capacity,
            'published'    => $this->published,
        ];
    }
}
