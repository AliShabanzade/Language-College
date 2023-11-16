<?php

namespace App\Actions\Bok;

use App\Enums\PermissionEnum;
use App\Models\Bok;
use App\Repositories\Bok\BokRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBokAction
{
    use AsAction;

    public function __construct(private readonly BokRepositoryInterface $repository)
    {
    }


    /**
     * @param Bok                                          $bok
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Bok
     */
    public function handle(Bok $bok, array $payload): Bok
    {
        return DB::transaction(function () use ($bok, $payload) {
            $bok->update($payload);
            return $bok;
        });
    }
}
