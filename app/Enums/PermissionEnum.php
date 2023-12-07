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


    case BOOK_ALL = "book.all";
    case BOOK_INDEX = "book.index";
    case BOOK_SHOW = "book.show";
    case BOOK_STORE = "book.store";
    case BOOK_UPDATE = "book.update";
    case BOOK_TOGGLE = "book.toggle";
    case BOOK_DELETE = "book.delete";
    case BOOK_RESTORE = "book.restore";


    case NOTICE_ALL = "notice.all";
    case NOTICE_INDEX = "notice.index";
    case NOTICE_SHOW = "notice.show";
    case NOTICE_STORE = "notice.store";
    case NOTICE_UPDATE = "notice.update";
    case NOTICE_TOGGLE = "notice.toggle";
    case NOTICE_DELETE = "notice.delete";
    case NOTICE_RESTORE = "notice.restore";


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


    case CART_ALL = "cart.all";
    case CART_INDEX = "cart.index";
    case CART_SHOW = "cart.show";
    case CART_STORE = "cart.store";
    case CART_UPDATE = "cart.update";
    case CART_DELETE = "cart.delete";
    case CART_RESTORE = "cart.restore";



    case ORDER_ALL = "order.all";
    case ORDER_INDEX = "order.index";
    case ORDER_SHOW = "order.show";
    case ORDER_STORE = "order.store";
    case ORDER_UPDATE = "order.update";
    case  ORDER_TOGGLE = "order.toggle";
    case ORDER_DELETE = "order.delete";
    case ORDER_RESTORE = "order.restore";



    case ORDER_ITEM_ALL = "order-item.all";
    case ORDER_ITEM_INDEX = "order-item.index";
    case ORDER_ITEM_SHOW = "order-item.show";
    case ORDER_ITEM_STORE = "order-item.store";
    case ORDER_ITEM_UPDATE = "order-item.update";
    case ORDER_ITEM_DELETE = "order-item.delete";
    case ORDER_ITEM_RESTORE = "order-item.restore";


    case BLOG_ALL = "blog.all";
    case BLOG_INDEX = "blog.index";
    case BLOG_SHOW = "blog.show";
    case BLOG_STORE = "blog.store";
    case BLOG_UPDATE = "blog.update";
    case BLOG_TOGGLE = "blog.toggle";
    case BLOG_DELETE = "blog.delete";
    case BLOG_RESTORE = "blog.restore";


}
