<?php

namespace App\Actions\Notice;

use App\Models\Notice;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteNoticeAction
{
    use AsAction;

    public function __construct(public readonly NoticeRepositoryInterface $repository)
    {
    }

    public function handle(Notice $notice): bool
    {
        return DB::transaction(function () use ($notice) {
            return $this->repository->delete($notice);
        });
    }
}
