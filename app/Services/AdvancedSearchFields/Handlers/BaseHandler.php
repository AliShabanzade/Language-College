<?php

namespace App\Services\AdvancedSearchFields\Handlers;

abstract class BaseHandler
{
    public const INPUT  = "input";
    public const DATE   = "date";
    public const SELECT = "select";
    public const NUMBER = "number";
    public const TIME   = "time";
    public const DATETIME   = "datetime";
    public const SINGLE_DATE   = "single_date";

    abstract public function handle(): array;

    public function add(string $key, string $label, string $type, array $options = []): array
    {
        return [
                "key"   => $key,
                "label" => $label,
                "type"  => $type,
            ] + (count($options) ? ["options" => $options] : []);
    }

    public function option(string $value, string $label): array
    {
        return compact('value', 'label');
    }
}
