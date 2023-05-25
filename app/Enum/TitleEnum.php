<?php

namespace App\Enum;

/**
 * Class TitleEnum
 * @package App\Enum
 */
enum TitleEnum: string
{

    case MR = 'Mr';

    case MRS = 'Mrs';

    case MISS = 'Miss';

    case MS = 'Ms';

    case DR = "Dr";

    case Prof = "Prof";


    /**
     * @return array
     */
    public static function toArray() {
        $array = [];
        foreach (self::cases() as $case){
            $array[] = $case->value;
        }
        return $array;
    }
}
