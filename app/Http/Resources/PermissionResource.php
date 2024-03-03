<?php

namespace App\Http\Resources;

use App\Enums\PermissionEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'   => $this->id,
            'name' => $this->name,
            'translated_name' => PermissionEnum::tryFrom($this->name)?->title()??'removed-permission',
        ];



    }
}
