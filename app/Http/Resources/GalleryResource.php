<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'       => GetTranslationAction::run($this->resource, 'title'),
//            'slug'        => $this->resource->slug,
            'description' => GetTranslationAction::run($this->resource, 'description'),
            'user'        => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category'    => $this->whenLoaded('category', fn() => CategoryResource::make($this->resource->category)),
            'comment'     => $this->whenLoaded('comments', fn() => CommentResource::collection($this->resource->comments)),
            'like'        => $this->whenLoaded('likes', fn() => LikeResource::collection($this->resource->likes)),
            'view'        => $this->whenLoaded('views', fn() => ViewResource::collection($this->resource->views)),
            'published'   => $this->resource->published,
            'media'       => $this->resource->getMedia('gallery'),
            'view_count'  => $this->resource->extra_attributes->get('view_count', 0),

        ];
    }
}
