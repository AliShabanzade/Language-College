<?php

namespace App\Actions\TermDate;

use App\Enums\PermissionEnum;
use App\Models\TermDate;
use App\Repositories\TermDate\TermDateRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTermDateAction
{
    use AsAction;

    public function __construct(private readonly TermDateRepositoryInterface $repository)
    {
    }


    /**
     * @param TermDate                                          $termDate
     * @param array{name:string,mobile:string,email:string} $payload
     * @return TermDate
     */
    public function handle(TermDate $termDate, array $payload): TermDate
    {
        return DB::transaction(function () use ($termDate, $payload) {
            $termDate->update($payload);
            return $termDate;
        });
    }
}
