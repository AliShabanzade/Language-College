<?php

namespace App\Actions\Notice;

use App\Enums\PermissionEnum;
use App\Models\Notice;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateNoticeAction
{
    use AsAction;

    public function __construct(private readonly NoticeRepositoryInterface $repository)
    {
    }


    /**
     * @param Notice                                          $notice
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Notice
     */
    public function handle(Notice $notice, array $payload): Notice
    {
        return DB::transaction(function () use ($notice, $payload) {
            $notice->update($payload);
            return $notice;
        });
    }
}
