<?php

namespace App\Services\AdvancedSearchFields;

use App\Helpers\StringHelper;
use App\Services\Core\CoreService;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;
class AdvanceFilter implements Filter
{
    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(Builder $query, $value, string $property): void
    {
        $handler = app("App\\Services\\AdvancedSearchFields\\Drivers\\" . StringHelper::convertToClassName(CoreService::getKeyFromEloquent($query->getModel()::class)) . "Driver");
        $handler->handle($query, $value);
    }
}
