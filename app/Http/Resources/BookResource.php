<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->resource->id,
            'name' => GetTranslationAction::run($this->resource,'name'),
            'slug' => $this->resource->slug,
            'inventory' => $this->resource->inventory,
            'price' => $this->resource->price,
            'pages' => $this->resource->pages,
            'sales' => $this->resource->sales,
            'writer' => GetTranslationAction::run($this->resource,'writer'),
            'user' => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category' => $this->whenloaded('category', fn() => CategoryResource::make($this->resource->category)),
            'publication' => $this->whenloaded('publication', fn() => PublicationResource::make($this->resource->publication)),
//            'extra_attributes' => collect($this->resource['extra_attributes'])->mapWithKeys(function ($value, $key) {
//                return [$key => $value ?? null];
//            })->all(),
            'extra_attributes'=>$this->extra_attributes->get('color'),
            'extra_attributes'=>$this->extra_attributes->get('weight'),

            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'media' => $this->resource->getMedia('book'),
        ];
    }
}
