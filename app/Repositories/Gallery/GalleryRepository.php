<?php

namespace App\Repositories\Gallery;

use App\Models\Gallery;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Gallery
   {
       return parent::getModel();
   }

   public function query(array $payload = []): Builder|QueryBuilder
   {
       return parent::query($payload)->with('user', 'media');
   }
}
