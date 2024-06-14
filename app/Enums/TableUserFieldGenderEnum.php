<?php

namespace App\Enums;

enum TableUserFieldGenderEnum: string
{
    use EnumToArray;

    case  MEN = "men";
    case WOMEN = "women";
}
