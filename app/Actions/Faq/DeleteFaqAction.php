<?php

namespace App\Actions\Faq;

use App\Models\Faq;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFaqAction
{
    use AsAction;

    public function __construct(public readonly FaqRepositoryInterface $repository)
    {
    }

    public function handle(Faq $faq): bool
    {
        return DB::transaction(function () use ($faq) {
            return $this->repository->delete($faq);
        });
    }
}
