<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'title' => [
                'title' => __('termDate.title'),
                'value' => $this->whenLoaded('translations',
                    GetTranslationAction::run($this->resource, 'title')),
            ],
            'start' => $this->start,
            'end'   => $this->end,
        ];
    }
}
