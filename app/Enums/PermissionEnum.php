<?php

namespace App\Enums;




enum PermissionEnum: string
{

    case ADMIN = "admin";

    case USER_ALL = "user.all";
    case USER_INDEX = "user.index";
    case USER_SHOW = "user.show";
    case USER_STORE = "user.store";
    case USER_UPDATE = "user.update";
    case USER_TOGGLE = "user.toggle";
    case USER_DELETE = "user.delete";
    case USER_RESTORE = "user.restore";




    case FAQ_ALL = "faq_make.all";
    case FAQ_INDEX = "faq_make.index";
    case FAQ_SHOW = "faq_make.show";
    case FAQ_STORE = "faq_make.store";
    case FAQ_UPDATE = "faq_make.update";
    case FAQ_TOGGLE = "faq_make.toggle";
    case FAQ_DELETE = "faq_make.delete";
    case FAQ_RESTORE = "faq_make.restore";







}
