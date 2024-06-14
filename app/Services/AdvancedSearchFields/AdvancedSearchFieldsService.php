<?php

namespace App\Services\AdvancedSearchFields;

use App\Helpers\StringHelper;
use App\Services\Core\CoreService;

class AdvancedSearchFieldsService
{
    public static function generate($model): array
    {
        $handler = app("App\\Services\\AdvancedSearchFields\\Handlers\\" . StringHelper::convertToClassName(CoreService::getKeyFromEloquent($model)) . "Handler");
        return $handler->handle();
    }
}
