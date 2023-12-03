<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->resource->id,
            'title'        => $this->resource->title,
            'description'  => $this->resource->description,
            'media'        => $this->resource->getMedia('blog'),
            'reading_time' => $this->resource->reading_time,
            'published'    => $this->resource->published,
            'created_at'   => $this->resource->created_at,
            'user_id'      => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category_id'  => $this->whenLoaded('category', fn() => CategoryResource::make($this->resource->category)),
            'like'         => $this->whenLoaded('likes', fn() => LikeResource::collection($this->resource->likes)),
            'view'         => $this->whenLoaded('views', fn() => ViewResource::collection($this->resource->views)),
            'comment'      => $this->whenLoaded('comments', fn() => CommentResource::collection($this->resource->comments)),
        ];
    }
}
