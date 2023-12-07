<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Book
    {
        return parent::getModel();
    }

    public function subtractBookInventory($bookId, $quantity): void
    {
        $book = $this->getModel()->find($bookId);

        if ($book) {
            $newInventory = max(0, $book->inventory - $quantity);
            $book->update(['inventory' => $newInventory]);
        }
    }
}
