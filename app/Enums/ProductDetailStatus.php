<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductDetailStatus extends Enum
{
    public const DANG_BAN = 0;
    public const NGUNG_BAN = 1;
     
    public static function getArrayView(){
        return [
            'dang ban'=> self::DANG_BAN,
            'ngung ban'=> self::NGUNG_BAN
        ];
    }
}
