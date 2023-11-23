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


    case NOTICE_ALL = "notice.all";
    case NOTICE_INDEX = "notice.index";
    case NOTICE_SHOW = "notice.show";
    case NOTICE_STORE = "notice.store";
    case NOTICE_UPDATE = "notice.update";
    case NOTICE_TOGGLE = "notice.toggle";
    case NOTICE_DELETE = "notice.delete";
    case NOTICE_RESTORE = "notice.restore";







}
