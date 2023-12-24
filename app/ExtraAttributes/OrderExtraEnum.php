<?php

namespace App\ExtraAttributes;

enum OrderExtraEnum: string
{
    case CREATED_BY = "created_by";
    case CANCELED_BY = "canceled_by";
    case DELETED_BY = "deleted_by";
}
