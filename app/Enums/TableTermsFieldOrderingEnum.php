<?php

namespace App\Enums;

enum TableTermsFieldOrderingEnum: int
{
    use EnumToArray;

    case TERM_ONE = 1;
    case TERM_TWO = 2;
    case TERM_THREE = 3;
    case TERM_FOUR = 4;
    case TERM_FIVE = 5;
    case TERM_SIX = 6;
    case TERM_SEVEN = 7;
    case TERM_EIGHT = 8;
    case TERM_NINE = 9;
    case TERM_TEN = 10;
    case TERM_ELEVEN = 11;
    case TERM_TWELVE = 12;
    case TERM_THIRTEEN = 13;
    case TERM_FOURTEEN = 14;
    case TERM_FIFTEEN = 15;
    case TERM_SIXTEEN = 16;


    public function title(): array|string|Translator|Application|null|int
    {
        return match ($this) {
            self::TERM_ONE      => __('term.term_one'),
            self::TERM_TWO      => __('term.term_two'),
            self::TERM_THREE    => __('term.term_three'),
            self::TERM_FOUR     => __('term.term_four'),
            self::TERM_FIVE     => __('term.term_five'),
            self::TERM_SIX      => __('term.term_six'),
            self::TERM_SEVEN    => __('term.term_seven'),
            self::TERM_EIGHT    => __('term.term_eight'),
            self::TERM_NINE     => __('term.term_nine'),
            self::TERM_TEN      => __('term.term_ten'),
            self::TERM_ELEVEN   => __('term.term_eleven'),
            self::TERM_TWELVE   => __('term.term_twelve'),
            self::TERM_THIRTEEN => __('term.term_thirteen'),
            self::TERM_FOURTEEN => __('term.term_fourteen'),
            self::TERM_FIFTEEN  => __('term.term_fiveteen'),
            self::TERM_SIXTEEN  => __('term.term_sixteen'),

        };
    }
}
