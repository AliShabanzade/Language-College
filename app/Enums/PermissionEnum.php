<?php

namespace App\Enums;


enum PermissionEnum: string
{
    use EnumToArray;
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

    case SETTING_ALL = "setting.all";
    case SETTING_INDEX = "setting.index";
    case SETTING_SHOW = "setting.show";
    case SETTING_STORE = "setting.store";
    case SETTING_UPDATE = "setting.update";
    case SETTING_DELETE = "setting.delete";

    case FAV_ALL = "fav.all";
    case FAV_INDEX = "fav.index";
    case FAV_SHOW = "fav.show";
    case FAV_STORE = "fav.store";
    case FAV_UPDATE = "fav.update";
    case FAV_DELETE = "fav.delete";


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


    case GALLERY_ALL = "gallery.all";
    case GALLERY_INDEX = "gallery.index";
    case GALLERY_SHOW = "gallery.show";
    case GALLERY_STORE = "gallery.store";
    case GALLERY_UPDATE = "gallery.update";
    case GALLERY_TOGGLE = "gallery.toggle";
    case GALLERY_DELETE = "gallery.delete";
    case GALLERY_RESTORE = "gallery.restore";

    case COLLEGE_ALL = "college.all";
    case COLLEGE_INDEX = "college.index";
    case COLLEGE_SHOW = "college.show";
    case COLLEGE_STORE = "college.store";
    case COLLEGE_UPDATE = "college.update";
    case COLLEGE_TOGGLE = "college.toggle";
    case COLLEGE_DELETE = "college.delete";
    case COLLEGE_RESTORE = "college.restore";

    case COURSE_ALL = "course.all";
    case COURSE_INDEX = "course.index";
    case COURSE_SHOW = "course.show";
    case COURSE_STORE = "course.store";
    case COURSE_UPDATE = "course.update";
    case COURSE_TOGGLE = "course.toggle";
    case COURSE_DELETE = "course.delete";
    case COURSE_RESTORE = "course.restore";
    public function title()
    {
        return array_merge(
            $this->generateDefaultGroupTitle("user"),


            $this->generateDefaultGroupTitle("setting"),
            [
                "ADMIN"                           => trans('permissions.admin'),
            ]
        )[$this->value] ?? $this->name;
    }

    private function generateDefaultGroupTitle($TYPE): array
    {
        return [
            "$TYPE.all"     => trans("permissions.$TYPE.all"),
            "$TYPE.index"   => trans("permissions.$TYPE.index"),
            "$TYPE.show"    => trans("permissions.$TYPE.show"),
            "$TYPE.store"   => trans("permissions.$TYPE.store"),
            "$TYPE.update"  => trans("permissions.$TYPE.update"),
            "$TYPE.toggle"  => trans("permissions.$TYPE.toggle"),
            "$TYPE.delete"  => trans("permissions.$TYPE.delete"),
            "$TYPE.restore" => trans("permissions.$TYPE.restore"),
        ];
    }
}
