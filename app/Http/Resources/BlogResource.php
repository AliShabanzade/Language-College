<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded(string $string)
 */
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
            'title'        => $this->whenLoaded('translations', fn() => GetTranslationAction::run($this->resource, 'title')),
            'description'  => $this->when(request()?->route()?->getName() !== 'blog.index' && $this->relationLoaded('translations'), function () {
                return GetTranslationAction::run($this->resource, 'description');
            }),
            'reading_time' => $this->resource->reading_time,
            'published'    => $this->resource->published,
            'created_at'   => $this->resource->created_at,
            'media'        => $this->resource->getMedia('blog'),
            'user_id'      => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category_id'  => $this->whenLoaded('category', fn() => CategoryResource::make($this->resource->category)),
            'view_count' => [
                'title'=>__('general.view_count'),
                'value'=> $this->extra_attributes->get('view_count'),
            ],
            'comment_count' => [
                'title'=>__('general.comment_count'),
                'value'=> $this->extra_attributes->get('comment_count'),
            ],
            'like_count' => [
                'title'=>__('general.like_count'),
                'value'=> $this->extra_attributes->get('like_count'),
            ],
        ];
    }
}
