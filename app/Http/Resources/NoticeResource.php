<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use App\ExtraAttributes\BaseExtraEnum;
use App\ExtraAttributes\BookExtraEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'title'       => GetTranslationAction::run($this->resource, 'title'),
            //            'slug'        => $this->resource->slug,
            'user'        => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category'    => $this->whenLoaded('category', fn() => CategoryResource::make($this->resource->category)),
            'comment_count'     => $this->resource->extra_attributes->get(BaseExtraEnum::COMMENT_COUNT->value, 0),
            'like_count'        => $this->resource->extra_attributes->get(BaseExtraEnum::LIKE_COUNT->value, 0),
            'view_count'        => $this->resource->extra_attributes->get(BaseExtraEnum::VIEW_COUNT->value, 0),
            'published'   => $this->resource->published,
            'media'       => $this->when($this->resource->relationLoaded('media') &&
                Str::contains($request->route()->getName(), 'show'), function () {
                return $this->resource->getFirstMediaUrl('notice', '480_480');
            }, $this->resource->getFirstMediaUrl('notice', '100_100')),
            'description' => GetTranslationAction::run($this->resource, 'description'),
        ];
    }
}
