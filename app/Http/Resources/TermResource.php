<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use App\Enums\TableTermsFieldOrderingEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
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
            'title'        => [
                'title' => __('term.title'),
                'value' => $this->whenLoaded('translations',
                    GetTranslationAction::run($this->resource, 'title')),
            ],
            'description'  => [
                'title' => __('term.description'),
                'value' => $this->whenLoaded('translations',
                    GetTranslationAction::run($this->resource, 'description'))
            ],
            'prerequisite'      => $this->whenLoaded('prerequisite', fn() => self::make($this->prerequisite)),
             'children' =>   $this->whenLoaded('children', function () {
                 return TermResource::collection($this->resource->children);
             }),

            'ordering'     => $this->ordering->title(),
            //'assessment'  => $this->assessment->title(),
            'course'       => $this->whenLoaded('course', fn() => CourseResource::make($this->course)),
        ];
    }
}
