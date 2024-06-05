<?php

namespace App\Enum;

enum PlayerLevelEnum: int
{
    case VERY_POOR = 1;
    case POOR = 2;
    case AVERAGE = 3;
    case GOOD = 4;
    case VERY_GOOD = 5;

    public static function getLevelByValue(int $value): self
    {
        return match ($value) {
            self::VERY_POOR->value => self::VERY_POOR,
            self::POOR->value => self::POOR,
            self::AVERAGE->value => self::AVERAGE,
            self::GOOD->value => self::GOOD,
            self::VERY_GOOD->value => self::VERY_GOOD,
        };
    }
}
