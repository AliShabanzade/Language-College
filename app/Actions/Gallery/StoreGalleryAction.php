<?php

namespace App\Actions\Gallery;

use App\Models\Gallery;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreGalleryAction
{
    use AsAction;

    public function __construct(private readonly GalleryRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Gallery
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
