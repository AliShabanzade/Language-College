<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\EnumToArray;

enum ClassroomViewTypeEnum: string
{
       use EnumToArray;

       case FIND_COURSE="find_course";
       case FIND_TERM="find_term";

}
