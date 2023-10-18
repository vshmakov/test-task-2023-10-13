<?php

declare(strict_types=1);

namespace App\Money;

use Money\Money;

abstract class MoneyHelper
{
    public static function floatToEur(float $amount): Money
    {
        return Money::EUR(
            (int) ($amount * 100)
        );
    }

    public static function eurToFloat(Money $money): float
    {
        return ((float) $money->getAmount()) / 100;
    }

    public static function calculatePercent(Money $money, float $percent): Money
    {
        return $money->multiply($percent / 100);
    }
}
