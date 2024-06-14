<?php

namespace App\Repositories\Session;

use App\Models\Session;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Session::class)
            ->when(\Arr::get($payload, 'with', []), fn($q) => $q->with(\Arr::get($payload, 'with')));
    }
}
