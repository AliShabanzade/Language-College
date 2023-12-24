<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'        => $this->name,
            'mime_type'   => $this->mime_type,
            'size'        => $this->size,
            'preview_url' => $this->preview_url,
            'url'         => $this->original_url
        ];
    }
}
