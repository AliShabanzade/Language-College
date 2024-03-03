<?php


namespace App\Enums;

enum TableAttendanceFieldStatusTypeEnum: string
{
    use EnumToArray;

    case PRESENT = 'present';
    case ABSENT = 'absent';


    public function title()
    {
        return match ($this) {
            self::PRESENT => __("attendance.present"),
            self::ABSENT => __("attendance.absent"),
        };
    }

    public function localisation(): array
    {
        return match ($this) {
            self::PRESENT => [
                'value' => 'present',
                'label' => __('attendance.present'),
                'badge' => '#1FB863',
                'bgColor' => '#EEFBF4',
            ],
            self::ABSENT => [
                'value' => 'absent',
                'label' => __('attendance.absent'),
                'badge' => '#FF132F',
                'bgColor' => '#FFE5E8',
            ],

        };
    }
}

