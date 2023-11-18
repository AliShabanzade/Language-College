<?php

namespace App\Actions\Test2;

use App\Enums\PermissionEnum;
use App\Models\Test2;
use App\Repositories\Test2\Test2RepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTest2Action
{
    use AsAction;

    public function __construct(private readonly Test2RepositoryInterface $repository)
    {
    }


    /**
     * @param Test2                                          $test2
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Test2
     */
    public function handle(Test2 $test2, array $payload): Test2
    {
        return DB::transaction(function () use ($test2, $payload) {
            $test2->update($payload);
            return $test2;
        });
    }
}
