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
            'id'   => $this->resource->id,
            'name' =>[
                'title'=>__('book.name'),
                'value'=>   $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'name')),
            ],
            'writer' => [
                'title'=>__('book.writer'),
                'value'=>   $this->whenloaded('translations',
                    GetTranslationAction::run($this->resource, 'writer')),
            ],
            'slug' => $this->resource->slug,
            'inventory' =>[
                'title'=>__('book.inventory'),
                'value'=>$this->inventory,
            ],
                $this->resource->inventory,
            'price' =>[
                'title'=>__('book.price'),
                'value'=>$this->price
            ],
            'pages' => [
                'title'=>__('book.pages'),
                'value'=>$this->pages,
            ],
            'user'  => $this->whenLoaded('user',
                fn() => UserResource::make($this->resource->user)),
            'category' => $this->whenloaded('category',
                fn() => CategoryResource::make($this->resource->category)),
            'publication' => [
                'title'=>__('book.publication'),
                'value'=>   $this->whenloaded('publication',
                    fn() => PublicationResource::make($this->resource->publication)),
            ],
            'published'  => $this->published,
            'color'      =>  [
                'title'=>__('book.color'),
                'value'=> $this->extra_attributes->get('color'),
            ],
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
            'created_at' => [
                    'title'=>__('general.created_at'),
                    'value'=>   $this->resource->created_at,
                ],

            'updated_at' => $this->resource->updated_at,
        ];
    }
}
