<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Comment
   {
       return parent::getModel();
   }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return parent::query($payload)->with(['user','likes']);
    }


}
