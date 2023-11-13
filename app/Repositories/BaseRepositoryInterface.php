<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

interface BaseRepositoryInterface
{

    public function query(array $payload = []): Builder|QueryBuilder;

    public function paginate($limit = 15, array $payload = []);

    public function get(array $payload = []): Collection|array;

    public function store(array $payload);

    public function update($eloquent, array $payload);

    public function delete($eloquent): bool;

    public function find(mixed $value, string $field = 'id', array $selected = ['*'], bool $firstOrFail = false, array $with = []);

    public function getModel():Model;

    public function toggle($model, string $field = "published");

    public function updateOrCreate(array $data, array $conditions=[]);
    public function data(array $payload=[]): array;
}
