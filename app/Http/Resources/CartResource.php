<?php

namespace App\Http\Resources;

use App\Models\Book;
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
            'id' => $this->id,
            'book_id'  => $this->book_id,
            'quantity' => $this->quantity,
            'user'     => $this->user_id,
            'book' => $this->whenLoaded('book' , fn() => BookResource::make($this->book)),
        ];
    }
}
