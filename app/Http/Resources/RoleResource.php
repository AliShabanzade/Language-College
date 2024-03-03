<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'          => $this->resource->id,
            'name'       => $this->resource->name,
            'permissions' => $this->whenLoaded('permissions', function () {
                return PermissionResource::collection($this->resource->permissions);
            }),
        ];
    }
}
