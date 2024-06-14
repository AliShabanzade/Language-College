<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use Illuminate\Database\Eloquent\Builder;

class ClassroomDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        return $this->filter($query, $values);
    }
}
