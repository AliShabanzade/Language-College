<?php

namespace App\Enums;

enum RoleEnum :string
{
    case ADMIN = 'admin';
    case WRITER = 'writer';
    case  SUPPORT = 'support';
}
