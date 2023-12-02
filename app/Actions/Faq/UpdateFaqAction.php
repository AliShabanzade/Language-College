<?php

namespace App\Actions\Faq;

use App\Enums\PermissionEnum;
use App\Models\Faq;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFaqAction
{
    use AsAction;

    public function __construct(private readonly FaqRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }


    /**
     * @param Faq                                           $faq
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Faq
     */
    public function handle(Faq $faq, array $payload): Faq
    {

        return DB::transaction(function () use ($payload, $faq) {
            if ($faq->category->id && $faq->category->type === "App\Models\Faq") {
                $payload['user_id'] = Auth::user()->id;
                $faq = $this->repository->update($faq, $payload);

            }
            return $faq;
        });
    }
}
