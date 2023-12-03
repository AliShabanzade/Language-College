<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

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

    public function query(array $payload=[]):Builder
    {
        return parent::query($payload)->with(['category','user','publication']);
    }

}
