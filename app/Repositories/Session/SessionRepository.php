<?php

namespace App\Repositories\Session;

use App\Models\Session;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class SessionRepository extends BaseRepository implements SessionRepositoryInterface
{
    public function __construct(Session $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Session
   {
       return parent::getModel();
   }
}
