<?php

namespace App\Repositories\Publication;

use App\Models\Publication;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PublicationRepository extends BaseRepository implements PublicationRepositoryInterface
{
    public function __construct(Publication $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Publication
   {
       return parent::getModel();
   }
}
