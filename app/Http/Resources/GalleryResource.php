<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use App\ExtraAttributes\GalleryExtraEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'comment'     => $this->resource->extra_attributes->get(GalleryExtraEnum::COMMENT_COUNT->value, 0),
            'like'        => $this->resource->extra_attributes->get(GalleryExtraEnum::LIKE_COUNT->value, 0),
            'view'        => $this->resource->extra_attributes->get(GalleryExtraEnum::VIEW_COUNT->value, 0),
            'published'   => $this->resource->published,
            'media'       => $this->when(Str::contains($request->route()->getName(), 'show'), function () {
                return $this->resource->getFirstMediaUrl('gallery', '1080');
            }, $this->resource->getFirstMediaUrl('gallery', 'thumbnail')),
            'view_count'  => $this->resource->extra_attributes->get('view_count', 0),

        ];
    }
}
