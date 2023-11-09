<?php

namespace App\Actions\Book;

use App\Enums\PermissionEnum;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBookAction
{
    use AsAction;

    public function __construct(private readonly BookRepositoryInterface $repository)
    {
    }


    /**
     * @param Book                                          $book
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Book
     */
    public function handle(Book $book, array $payload): Book
    {
        return DB::transaction(function () use ($book, $payload) {
            $book->update($payload);
            return $book;
        });
    }
}