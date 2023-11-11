<?php

namespace App\Actions\Testone;

use App\Enums\PermissionEnum;
use App\Models\Testone;
use App\Repositories\Testone\TestoneRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTestoneAction
{
    use AsAction;

    public function __construct(private readonly TestoneRepositoryInterface $repository)
    {
    }


    /**
     * @param Testone                                          $testone
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Testone
     */
    public function handle(Testone $testone, array $payload): Testone
    {
        return DB::transaction(function () use ($testone, $payload) {
            $testone->update($payload);
            return $testone;
        });
    }
}
