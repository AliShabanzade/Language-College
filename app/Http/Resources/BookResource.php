<?php

namespace App\Http\Resources;

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
            'name'        => $this->name,
            'slug'        => $this->slug,
            'publication' => $this->publication,
            'user_id'     => $this->whenLoaded('user', fn() => UserResource::make($this->user)),
            'category_id' => $this->whenloaded('category', fn() => CategoryResource::make($this->category)),
            'inventory'   => $this->inventory,
            'published'   => $this->published,
            'price'       => $this->price,
            'pages'       => $this->pages,
            'sales'       => $this->sales,
            'writer'      => $this->writer,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
