<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use App\Actions\Translation\TranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'        => $this->id,
            'title'     => GetTranslationAction::run($this->resource, 'title'),
            'published' =>  [
                'value' => $this->published,
                'label' => $this->published ? __('general.suspended') : __('general.active'),
                'badge' => $this->published ? '#ef305e' : '#66d398',
            ],

            'type'      => $this->type,
            'children'  => $this->whenLoaded('children', function () {
                return CategoryResource::collection($this->children);
            }),
            'parent'    => $this->whenLoaded('parent', function () {
                return CategoryResource::make($this->parent);
            }),
            'books'    => $this->whenLoaded('books', function () {
                return BookResource::collection($this->resource->books);
            }),

        ];
    }
}
