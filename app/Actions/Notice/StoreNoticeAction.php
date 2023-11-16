<?php

namespace App\Actions\Notice;

use App\Models\Notice;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreNoticeAction
{
    use AsAction;

    public function __construct(private readonly NoticeRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Notice
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
