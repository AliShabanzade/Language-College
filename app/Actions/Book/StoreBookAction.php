<?php

namespace App\Actions\Book;

use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreBookAction
{
    use AsAction;

    public function __construct(private readonly BookRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Book
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
