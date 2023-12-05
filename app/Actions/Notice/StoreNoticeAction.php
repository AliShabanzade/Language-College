<?php

namespace App\Actions\Notice;

use App\Actions\Translation\SetTranslationAction;
use App\Models\Notice;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreNoticeAction
{
    use AsAction;

    public function __construct(private readonly NoticeRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function handle(array $payload): Notice
    {
        return DB::transaction(function () use ($payload) {
            $category = $this->categoryRepository->find($payload['category_id']);
            $payload['user_id'] = auth()->id();
            /** @var Notice $notice */
            $notice = $this->repository->store($payload);
            SetTranslationAction::run($notice, $payload['translations']);
            $notice->save();

            if (request()->hasFile('media')) {
                $notice->addMediaFromRequest('media')
                       ->toMediaCollection('notice');
            }

            return $notice;
        });
    }
}

