<?php

namespace App\Actions\Notice;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Notice;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateNoticeAction
{
    use AsAction;

    public function __construct(
        private readonly NoticeRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }


    /**
     * @param Notice                                        $notice
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Notice
     */
    public function handle(Notice $notice, array $payload): Notice
    {
        return DB::transaction(function () use ($notice, $payload) {
            $category = $this->categoryRepository->find($payload['category_id']);

            if ($category->type == Notice::class) {
                $payload['user_id'] = auth()->user()->id;
                $model = $this->repository->update($notice, $payload);
                $model->extra_attributes->set($payload['extra_attributes']);
                $model->save();
                SetTranslationAction::run($notice, $payload['translations']);

                if (isset($payload['media'])) {
                    $notice->media()->delete();
                    $notice->addMediaFromRequest('media')
                           ->toMediaCollection('notice');
                }
            }

            return $notice->load('translations');
        });
    }
}
