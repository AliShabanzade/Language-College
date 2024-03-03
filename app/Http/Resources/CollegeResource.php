<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollegeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'=>$this->id,
            'slug'=>$this->resource->slug,
            'title' =>[
                'title'=>__('college.title'),
                'value'=>   $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'title')),
            ],
            'description' =>[
                'title'=>__('college.description'),
                'value'=>   $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'description')),
            ],
            'address' =>[
                'title'=>__('college.address'),
                'value'=>   $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'address')),
            ],
        ];
    }
}
