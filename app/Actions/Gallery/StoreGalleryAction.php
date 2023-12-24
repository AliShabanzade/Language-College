<?php

namespace App\Actions\Gallery;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Gallery;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @property $categoryRepository
 */
class StoreGalleryAction
{
    use AsAction;

    public function __construct(private readonly GalleryRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function handle(array $payload): Gallery
    {
        return DB::transaction(function () use ($payload) {
            $category = $this->categoryRepository->find($payload['category_id']);
            if ($category->type == Gallery::class) {
                $gallery = $this->repository->store($payload);
                SetTranslationAction::run($gallery, $payload['translations']);
                if (request()->hasFile('media')) {
                    $gallery->addMediaFromRequest('media')
                            ->toMediaCollection('gallery');
                }
                return $gallery;
            }
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, "");
        });
    }
}
