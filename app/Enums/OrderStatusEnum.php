<?php

namespace App\Enums;


enum OrderStatusEnum: string
{
    use EnumToArray;

    case PENDING = "pending";
    case PAID = "paid";
    case EXPIRED = "expired";
    case CANCELED = "canceled";

    public function title(): string
    {
        return match ($this) {
            self::PAID => "پرداخت شده",
            self::PENDING => "در انتظار پرداخت",
            self::EXPIRED => "منقضی شده ",
            self::CANCELED => "لغو شده",
        };

    }
}
