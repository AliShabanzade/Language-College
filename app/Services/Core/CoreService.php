<?php

namespace App\Services\Core;

use Illuminate\Support\Str;

class CoreService
{
    public static function getKeyFromEloquent($class): string
    {
        return Str::kebab(last(explode("\\", $class)));
    }
}
