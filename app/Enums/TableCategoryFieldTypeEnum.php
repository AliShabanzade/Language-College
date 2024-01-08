<?php

namespace App\Enums;

use App\Models\Book;

enum TableCategoryFieldTypeEnum: string
{
    use EnumToArray;
	case BOOK = 'book';
	case BLOG = 'blog';
	case FAQ = 'faq';
	case NOTICE = 'notice';
}
