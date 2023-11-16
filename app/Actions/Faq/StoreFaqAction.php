<?php

namespace App\Actions\Faq;

use App\Models\Faq;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreFaqAction
{
    use AsAction;

    public function __construct(private readonly FaqRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Faq
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
