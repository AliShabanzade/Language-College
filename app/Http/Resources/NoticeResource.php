<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            'user'        => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category'    => $this->whenLoaded('category', fn() => CategoryResource::make($this->resource->category)),
            'comment'     => $this->whenLoaded('comments', fn() => CommentResource::collection($this->resource->comments)),
            'like'        => $this->whenLoaded('likes', fn() => LikeResource::collection($this->resource->likes)),
            'view'        => $this->whenLoaded('views', fn() => ViewResource::collection($this->resource->views)),
            'published'   => $this->resource->published,
            'media'       => $this->resource->getMedia('notice')
        ];
    }
}
