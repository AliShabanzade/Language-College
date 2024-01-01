<?php


return [
    'model' => '',
    'admin' => 'ادمین',
    'user' => [
        'all' => 'تمام فعالیت های مربوط به کاربران',
        'index' => 'دیدن تمام کاربران',
        'show' => 'نمایش جزییات کاربران',
        'store' => 'ثبت کاربران جدید',
        'update' => 'ویرایش کاربران',
        'toggle' => 'غیرفعال کردن کاربران',
        'delete' => 'حذف کاربران',
        'restore' => 'بازگردانی کاربران',
    ],
];
function generatePermissionsFa($name): array
{
    return [
        'all' => "تمام فعالیت های مربوط به $name",
        'index' => "دیدن تمام $name",
        'show' => "نمایش جزییات $name",
        'store' => "ثبت $name جدید",
        'update' => "ویرایش $name",
        'toggle' => "غیرفعال کردن $name",
        'delete' => "حذف $name",
        'restore' => "بازگردانی $name",
    ];
}
