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
            'id'          => $this->resource->id,
            'name'        => $this->whenloaded('translations',
                fn()=> GetTranslationAction::run($this->resource, 'name')),
            'slug'        => $this->resource->slug,
            'inventory'   => $this->resource->inventory,
            'price'       => $this->resource->price,
            'pages'       => $this->resource->pages,
            'sales'       => $this->resource->sales,
            'writer'      => $this->whenloaded('translations',
                fn() => GetTranslationAction::run($this->resource, 'writer')),
            'user'        => $this->whenLoaded('user',
                fn() => UserResource::make($this->resource->user)),
            'category'    => $this->whenloaded('category',
                fn() => CategoryResource::make($this->resource->category)),
            'publication' => $this->whenloaded('publication',
                fn() => PublicationResource::make($this->resource->publication)),
            'published'=>$this->published,
            'color'      => $this->extra_attributes->get('color'),
            'weight'     => $this->extra_attributes->get('weight'),
            'view_count' => $this->extra_attributes->get('view_count', 0),
            'like_count' => $this->extra_attributes->get('like_count',0),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
