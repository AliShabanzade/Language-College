<?php

namespace App\Enums;

enum TableSessionFieldTypeEnum:string
{
    use EnumToArray;

    case IN_PERSON = "in_person";
    case NOT_IN_PERSON = "not_in_perosn";

    public function title(): string
    {
        return match ($this) {
            self::NOT_IN_PERSON => __("session.not_in_person"),
            self::IN_PERSON     => __("session.in_person"),
        };
    }
}
