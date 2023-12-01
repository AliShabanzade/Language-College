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
//____________Role________________________________________
    case ROLE_ALL = "role.all";
    case ROLE_INDEX = "role.index";
    case ROLE_SHOW = "role.show";
    case ROLE_STORE = "role.store";
    case ROLE_UPDATE = "role.update";
    case ROLE_TOGGLE = "role.toggle";
    case ROLE_DELETE = "role.delete";
    case ROLE_RESTORE = "role.restore";
    case ROLE_ADD = "role.add";
    case ROLE_REMOVE = "role.remove";

    case PUBLICATION_ALL = "publication.all";
    case PUBLICATION_INDEX = "publication.index";
    case PUBLICATION_SHOW = "publication.show";
    case PUBLICATION_STORE = "publication.store";
    case PUBLICATION_UPDATE = "publication.update";
    case PUBLICATION_TOGGLE = "publication.toggle";
    case PUBLICATION_DELETE = "publication.delete";
    case PUBLICATION_RESTORE = "publication.restore";


}
