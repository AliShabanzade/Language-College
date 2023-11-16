<?php

namespace App\Actions\Test;

use App\Enums\PermissionEnum;
use App\Models\Test;
use App\Repositories\Test\TestRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTestAction
{
    use AsAction;

    public function __construct(private readonly TestRepositoryInterface $repository)
    {
    }


    /**
     * @param Test                                          $test
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Test
     */
    public function handle(Test $test, array $payload): Test
    {
        return DB::transaction(function () use ($test, $payload) {
            $test->update($payload);
            return $test;
        });
    }
}
