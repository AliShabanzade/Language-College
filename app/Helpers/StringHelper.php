<?php

namespace App\Helpers;

class StringHelper
{
    public static function convertToClassName($input): string
    {
        $names = explode('_', $input);
        if (count($names) === 1) {
            $names = explode('-', $input);
        }
        foreach ($names as $index => $name) {
            $names[$index] = ucwords(strtolower($name));
        }
        return implode('', $names);
    }


}
