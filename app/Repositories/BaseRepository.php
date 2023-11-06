<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class BaseRepository implements BaseReposirotyInterface
{

    public function __construct(public Model $model)
    {
    }

    public function query(array $payload = []): Builder
    {
          return $this->model->query($payload);

    }
    public function paginate(int $limit = 15, array $payload = []): LengthAwarePaginator
    {
          return $this->query($payload)->paginate($limit) ;
    }

    public function get(array $payload = [])
    {
        return $this->query($payload)->get();
    }



    public function store(array $payload): Model
    {
        return $this->model->create($payload);
    }

    public function update($eloquent, array $payload): Model
    {
        $eloquent->update($payload);
        return $eloquent;
    }

    public function delete($eloquent): bool
    {
        return $eloquent->delete();
    }

    public function find(int $id, array $payload = ['*']): Model
    {
             return $this->model->select($payload)->find($id);
    }

    public function findByUuid(string $uuid, array $payload = ['*'])
    {
         return $this->model->select($payload)->where('uuid',$uuid)->first;
    }
}
