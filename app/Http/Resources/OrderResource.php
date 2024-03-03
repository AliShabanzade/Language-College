<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'user'        => $this->whenLoaded('user',
                fn() => UserResource::make($this->resource->user)),
            'items'=>$this->whenLoaded('items',
                fn()=>OrderItemResource::collection($this->resource->items)),
            'status'  => $this->status,
            'total'   => $this->total,
        ];
    }
}
