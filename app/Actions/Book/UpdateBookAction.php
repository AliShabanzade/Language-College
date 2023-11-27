<?php

namespace App\Actions\Book;

use App\Actions\Translation\SetTranslationAction;
use App\Actions\Translation\TranslationAction;
use App\Enums\CategoryEnum;
use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBookAction
{
    use AsAction;

    public function __construct(private readonly BookRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }


    /**
     * @param Book                                          $book
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Book
     *
     */
    public function handle(Book $book, array $payload): Book
    {
        return DB::transaction(function () use ($book, $payload) {
            $category = $this->categoryRepository->find($payload['category_id']);
            if ($category->type == Book::class) {
                $payload['user_id'] = auth()->user()->id;
                $book->update($payload);
                SetTranslationAction::run($book, $payload['translation']);
                return $book;
            }

        });
    }
}
