<?php

namespace App\Actions\Book;

use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBookAction
{
    use AsAction;

    public function __construct(public readonly BookRepositoryInterface $repository)
    {
    }

    public function handle(Book $book): bool
    {
        return DB::transaction(function () use ($book) {
            $book->translations()->delete();
            $book->media()->delete();
            return $this->repository->delete($book);
        });
    }
}
