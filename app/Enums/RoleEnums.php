<?php

namespace App\Enums;

enum RoleEnums :string
{
    case ADMIN = 'admin';

    case USER = 'user';


    case WRITER = 'writer';

    case GUEST = 'guest';

    case  EDITOR = 'editor';

    case  VIEWER = 'viewer';

    case  SUBSCRIBER = 'subscriber';

    case    VIP_USER = 'vip_user';

    case CUSTOMER = 'customer';

    case  SUPPORT = 'support';

    case  API_USER = 'api_user';


    case SUPER_USER = 'super_user';



}
