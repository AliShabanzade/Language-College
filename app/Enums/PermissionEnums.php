<?php

namespace App\Enums;




enum PermissionEnums: string
{

    case ADMIN = "admin";
    case LOGIN_TO_THE_PANEL= "login to the panel";

    case USER_ALL = "user.all";
    case USER_INDEX = "user.index";
    case USER_SHOW = "user.show";
    case USER_STORE = "user.store";
    case USER_UPDATE = "user.update";
    case USER_TOGGLE = "user.toggle";
    case USER_DELETE = "user.delete";
    case USER_RESTORE = "user.restore";






    case PRODUCT_MAKE_ALL = "product_make.all";
    case PRODUCT_MAKE_INDEX = "product_make.index";
    case PRODUCT_MAKE_SHOW = "product_make.show";
    case PRODUCT_MAKE_STORE = "product_make.store";
    case PRODUCT_MAKE_UPDATE = "product_make.update";
    case PRODUCT_MAKE_TOGGLE = "product_make.toggle";
    case PRODUCT_MAKE_DELETE = "product_make.delete";
    case PRODUCT_MAKE_RESTORE = "product_make.restore";







}
