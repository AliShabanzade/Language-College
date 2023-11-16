<?php

namespace App\Repositories\Faq;

use App\Models\Faq;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Faq
   {
       return parent::getModel();
   }
}
