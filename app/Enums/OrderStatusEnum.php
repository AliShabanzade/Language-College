<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case PENDING = "pending";
    case PAID = "paid";
    case EXPIRED = "expired";
    case CANCELED = "canceled";
}
