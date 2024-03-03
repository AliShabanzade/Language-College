<?php

namespace App\Enums;

enum   TableCourseFieldTypeEnum: string
{
    use EnumToArray;

    case NOT_IN_PERSON = "not_in_person";
    case IN_PERSON = "in_person";

    public function title(): string
    {
        return match ($this) {
            self::NOT_IN_PERSON     => __("course.not_in_person"),
            self::IN_PERSON => __("course.in_person"),
        };
    }
}
