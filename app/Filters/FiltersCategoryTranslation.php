<?php

namespace App\Filters;

use App\Models\Translation;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersCategoryTranslation implements Filter
{
    protected array $params = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function __invoke(Builder $query, $value, string $property): void
    {
        foreach ($this->params as $param) {
            foreach ($param as $item) {
                $query->whereHas('translations', function (Builder $query) use ($value, $item) {
                    $query->where('value', $value)
                        ->where('key', $item);
                });
            }
        }
    }
}
