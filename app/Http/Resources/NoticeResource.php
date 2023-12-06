<?php

namespace App\Http\Resources;

use App\Actions\Translation\GetTranslationAction;
use App\ExtraAttributes\NoticeExtraEnum;
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
            'title'       => GetTranslationAction::run($this->resource, 'title'),
            //            'slug'        => $this->resource->slug,
            'description' => GetTranslationAction::run($this->resource, 'description'),
            'user'        => $this->whenLoaded('user', fn() => UserResource::make($this->resource->user)),
            'category'    => $this->whenLoaded('category', fn() => CategoryResource::make($this->resource->category)),
            'comment'     => $this->resource->extra_attributes->get(NoticeExtraEnum::COMMENT_COUNT->value, 0),
            'like'        => $this->resource->extra_attributes->get(NoticeExtraEnum::LIKE_COUNT->value ,0),
            'view'        => $this->resource->extra_attributes->get(NoticeExtraEnum::VIEW_COUNT->value, 0),
            'published'   => $this->resource->published,
            'media'       => $this->when(Str::contains($request->route()->getName(), '480'), function () {
                return $this->resource->getFirstMediaUrl('notice', '1080');
            }, $this->resource->getFirstMediaUrl('notice', 'thumbnail')),
            'view_count'  => $this->resource->extra_attributes->get('view_count', 0),
        ];
    }
}
