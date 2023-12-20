<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user' => $this->whenLoaded('user', function () {
                return UserCartResource::make($this->user);
            }),
            'book' => $this->whenLoaded('book', fn() => BookResource::make($this->book)),
        ];
    }
}
