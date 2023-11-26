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

    case OPINION_ALL = "opinion.all";
    case OPINION_INDEX = "opinion.index";
    case OPINION_SHOW = "opinion.show";
    case OPINION_STORE = "opinion.store";
    case OPINION_UPDATE = "opinion.update";
    case OPINION_TOGGLE = "opinion.toggle";
    case OPINION_DELETE = "opinion.delete";
    case OPINION_RESTORE = "opinion.restore";

    case COMMENT_ALL = "comment.all";
    case COMMENT_INDEX = "comment.index";
    case COMMENT_SHOW = "comment.show";
    case COMMENT_STORE = "comment.store";
    case COMMENT_UPDATE = "comment.update";
    case COMMENT_TOGGLE = "comment.toggle";
    case COMMENT_DELETE = "comment.delete";
    case COMMENT_RESTORE = "comment.restore";


}
