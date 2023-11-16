<?php

namespace App\Actions\Opinion;

use App\Enums\PermissionEnum;
use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateOpinionAction
{
    use AsAction;

    public function __construct(private readonly OpinionRepositoryInterface $repository)
    {
    }


    /**
     * @param Opinion                                          $opinion
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Opinion
     */
    public function handle(Opinion $opinion, array $payload): Opinion
    {
        return DB::transaction(function () use ($opinion, $payload) {
            $opinion->update($payload);
            return $opinion;
        });
    }
}
