<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'description' => [
                'title' => __('session.description'),
                'value' => $this->whenLoaded('translations',
                    GetTranslationAction::run($this->resource, 'description')),
            ],
            'classroom'   => $this->whenLoaded('classroom', fn() => ClassroomResource::make($this->classroom)),
            'term'         => $this->whenLoaded('term', fn() => TermResource::make($this->term)),

            'type'        => $this->resource->type,
            'start'       => $this->start,
            'end'         => $this->end,
            'ordering'    => $this->ordering,
            'duration'    => $this->duration,
            'date'        => $this->date,
        ];
    }
}
