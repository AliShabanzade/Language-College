<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrderStatusEnum: string
{
    use EnumToArray;

    case PENDING = "pending";
    case PAID = "paid";
    case EXPIRED = "expired";
    case CANCELED = "canceled";
}
