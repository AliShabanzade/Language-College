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

  //____________book___________________________
    case BOOK_ALL = "book.all";
    case BOOK_INDEX = "book.index";
    case BOOK_SHOW = "book.show";
    case BOOK_STORE = "book.store";
    case BOOK_UPDATE = "book.update";
    case BOOK_TOGGLE = "book.toggle";
    case BOOK_DELETE = "book.delete";
    case BOOK_RESTORE = "book.restore";



    case BLOG_ALL = "blog.all";
    case BLOG_INDEX = "blog.index";
    case BLOG_SHOW = "blog.show";
    case BLOG_STORE = "blog.store";
    case BLOG_UPDATE = "blog.update";
    case BLOG_TOGGLE = "blog.toggle";
    case BLOG_DELETE = "blog.delete";
    case BLOG_RESTORE = "blog.restore";


}
