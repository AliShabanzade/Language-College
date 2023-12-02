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

    case OPINION_ALL = "opinion.all";
    case OPINION_INDEX = "opinion.index";
    case OPINION_SHOW = "opinion.show";
    case OPINION_STORE = "opinion.store";
    case OPINION_UPDATE = "opinion.update";
    case OPINION_TOGGLE = "opinion.toggle";
    case OPINION_DELETE = "opinion.delete";
    case OPINION_RESTORE = "opinion.restore";

    case NOTICE_ALL = "notice.all";
    case NOTICE_INDEX = "notice.index";
    case NOTICE_SHOW = "notice.show";
    case NOTICE_STORE = "notice.store";
    case NOTICE_UPDATE = "notice.update";
    case NOTICE_TOGGLE = "notice.toggle";
    case NOTICE_DELETE = "notice.delete";
    case NOTICE_RESTORE = "notice.restore";

  //____________book___________________________
    case BOOK_ALL = "book.all";
    case BOOK_INDEX = "book.index";
    case BOOK_SHOW = "book.show";
    case BOOK_STORE = "book.store";
    case BOOK_UPDATE = "book.update";
    case BOOK_TOGGLE = "book.toggle";
    case BOOK_DELETE = "book.delete";
    case BOOK_RESTORE = "book.restore";


    case GALLERY_ALL = "gallery.all";
    case GALLERY_INDEX = "gallery.index";
    case GALLERY_SHOW = "gallery.show";
    case GALLERY_STORE = "gallery.store";
    case GALLERY_UPDATE = "gallery.update";
    case GALLERY_TOGGLE = "gallery.toggle";
    case GALLERY_DELETE = "gallery.delete";
    case GALLERY_RESTORE = "gallery.restore";
}
