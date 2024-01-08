<?php

namespace App\Repositories\Publication;

use App\Models\Publication;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function query(array $payload=[]):Builder|QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
            ->defaultSort('-id')
            ->with('translations');
   }
}
