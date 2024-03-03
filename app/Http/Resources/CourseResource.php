<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->resource->slug,
            'title' => [
                'title' => __('course.title'),
                'value' => $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'title')),
            ],
            'name' => [
                'title' => __('course.name'),
                'value' => $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'name')),
            ],
            'description' => [
                'title' => __('course.description'),
                'value' => $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'description')),
            ],
        ];
    }
}
