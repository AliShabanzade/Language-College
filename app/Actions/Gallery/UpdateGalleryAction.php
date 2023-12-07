<?php

namespace App\Actions\Gallery;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Gallery;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateGalleryAction
{
    use AsAction;

    public function __construct(private readonly GalleryRepositoryInterface $repository ,
        private readonly CategoryRepositoryInterface $categoryRepository)
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
            $category = $this->categoryRepository->find($payload['category_id']);

            if ($category->type == Gallery::class) {
                $payload['user_id'] = auth()->user()->id;
                $model = $this->repository->update($gallery, $payload);
                $model->extra_attributes->set($payload['extra_attributes']);
                $model->save();
                SetTranslationAction::run($gallery, $payload['translations']);

                if (isset($payload['media'])) {
                    $gallery->media()->delete();
                    $gallery->addMediaFromRequest('media')
                           ->toMediaCollection('gallery');
                }
            }

            return $gallery->load('translations');
        });
    }
}
