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
            'user_id'  => $this->user_id,
            'book_id'  => $this->book_id,
            'quantity' => $this->quantity,
            'payment'  => $this->payment,
            'user'     => $this->whenLoaded('user', fn() => UserResource::make($this->user)),
        ];
    }
}
