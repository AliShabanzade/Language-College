<?php

namespace App\Actions\Gallery;

use App\Enums\PermissionEnum;
use App\Models\Gallery;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateGalleryAction
{
    use AsAction;

    public function __construct(private readonly GalleryRepositoryInterface $repository)
    {
    }


    /**
     * @param Gallery                                          $gallery
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Gallery
     */
    public function handle(Gallery $gallery, array $payload): Gallery
    {
        return DB::transaction(function () use ($gallery, $payload) {
            $gallery->update($payload);
            return $gallery;
        });
    }
}
