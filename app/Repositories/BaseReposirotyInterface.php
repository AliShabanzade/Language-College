<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
interface BaseReposirotyInterface
{
    public function query(array $payload = []): Builder;
    public function paginate(int $limit = 15, array $payload = []);
    public function get(array $payload = []);
    public function store(array $payload): Model;
    public function update($eloquent, array $payload):Model;
    public function delete($eloquent): bool;
    public function find(int $id, array $payload = ['*']):Model;
    public function findByUuid(string $uuid, array $payload = ['*']);
    //public function PopularAccordingToLikes($model);
}



