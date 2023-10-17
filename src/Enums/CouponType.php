<?php

declare(strict_types=1);

namespace App\Enums;

enum CouponType: string
{
    case AMOUNT = 'amount';
    case PERCENT = 'percent';
}
