<?php

namespace App\Repositories\Fav;

use App\Models\Fav;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class FavRepository extends BaseRepository implements FavRepositoryInterface
{
    public function __construct(Fav $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Fav
   {
       return parent::getModel();
   }
}
