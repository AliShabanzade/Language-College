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
//_________________category________________
    case CATEGORY_ALL = "category.all";
    case CATEGORY_INDEX = "category.index";
    case CATEGORY_SHOW = "category.show";
    case CATEGORY_STORE = "category.store";
    case CATEGORY_UPDATE = "category.update";
    case CATEGORY_TOGGLE = "category.toggle";
    case CATEGORY_DELETE = "category.delete";
    case CATEGORY_RESTORE = "category.restore";



    case FAQ_ALL = "faq_make.all";
    case FAQ_INDEX = "faq_make.index";
    case FAQ_SHOW = "faq_make.show";
    case FAQ_STORE = "faq_make.store";
    case FAQ_UPDATE = "faq_make.update";
    case FAQ_TOGGLE = "faq_make.toggle";
    case FAQ_DELETE = "faq_make.delete";
    case FAQ_RESTORE = "faq_make.restore";




  //____________book___________________________
    case BOOK_ALL = "book.all";
    case BOOK_INDEX = "book.index";
    case BOOK_SHOW = "book.show";
    case BOOK_STORE = "book.store";
    case BOOK_UPDATE = "book.update";
    case BOOK_TOGGLE = "book.toggle";
    case BOOK_DELETE = "book.delete";
    case BOOK_RESTORE = "book.restore";



}
