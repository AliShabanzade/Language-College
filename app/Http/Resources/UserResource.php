<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'block'            => $this->block,
            'mobile'           => $this->mobile,
            'email'            => $this->email,
            'mobile_verify_at' => $this->mobile_verify_at,

            'avatar' => $this->when($this->relationLoaded('media') && Str::contains($request->route()->getName(), 'index'), function () {
                return $this->getFirstMediaUrl('avatar', '100_100');
            }, $this->getFirstMediaUrl('avatar', '512')),

            'national_card' => $this->when(
                $this->relationLoaded('media') && Str::contains($request->route()->getName(), 'show'), function () {
                return $this->getFirstMediaUrl('national_card','100_150');
            }),

            'national_card_bigger' => $this->when(
                $this->relationLoaded('media') && Str::contains($request->route()->getName(), 'show'), function () {
                return $this->getFirstMediaUrl('national_card','400_500');
            }),

            'passport' => $this->when(
                $this->relationLoaded('media')
                && Str::contains($request->route()->getName(), 'show'), function () {
                return $this->getFirstMediaUrl('passport','100_150');
            }),
            'passport_bigger' => $this->when(
                $this->relationLoaded('media')
                && Str::contains($request->route()->getName(), 'show'), function () {
                return $this->getFirstMediaUrl('passport','400_500');
            }),

            'cover' => $this->when($this->relationLoaded('media')
                && Str::contains($request->route()->getName(), 'show'), function () {
                return $this->getFirstMediaUrl('cover','1080');
            }),

        ];
    }
}
