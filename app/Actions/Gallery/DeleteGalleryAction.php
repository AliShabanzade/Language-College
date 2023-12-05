<?php

namespace App\Actions\Gallery;

use App\Models\Gallery;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteGalleryAction
{
    use AsAction;

    public function __construct(public readonly GalleryRepositoryInterface $repository)
    {
    }

    public function handle(Gallery $gallery): bool
    {
        return DB::transaction(function () use ($gallery) {
            $gallery->media()->delete();
            return $this->repository->delete($gallery);
        });
    }
}
