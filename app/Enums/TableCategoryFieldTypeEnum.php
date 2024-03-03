<?php

namespace App\Enums;

use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

enum TableCategoryFieldTypeEnum: string
{
    use  EnumToArray;
    case BOOK = 'book';
    case BLOG = 'blog';
    case FAQ = 'faq';
    case NOTICE = 'notice';

    public function title(): array|string|Translator|Application|null
    {
        return match ($this) {
            self::BOOK => __('category.book'),
            self::BLOG => __('category.blog'),
            self::FAQ => __('category.faq'),
            self::NOTICE => __('category.notice')
        };
    }
}
