<?php

namespace App\Repositories\Attribute;

use App\Models\Attribute;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Attribute
   {
       return parent::getModel();
   }
}
