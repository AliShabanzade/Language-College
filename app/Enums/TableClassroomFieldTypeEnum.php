<?php

namespace App\Enums;

enum TableClassroomFieldTypeEnum: string
{
    use EnumToArray;

    case IN_PROCESS = "in_process";
    case FINISHED = "finished";
    case NOT_STARTED = "not_started";

    public function title(): string
    {
        return match ($this) {
            self::IN_PROCESS  => __("classroom.in_process"),
            self::FINISHED    => __("classroom.finished"),
            self::NOT_STARTED => __("classroom.not_started"),
        };
    }
}
