<?php

namespace App\ExtraAttributes;

enum BaseExtraEnum: string
{
    case VIEW_COUNT = 'view_count';
    case COMMENT_COUNT = 'comment_count';
    case LIKE_COUNT = 'like_count';
}
