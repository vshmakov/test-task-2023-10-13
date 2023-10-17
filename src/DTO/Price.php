<?php

declare(strict_types=1);

namespace App\DTO;

use Money\Money;

final readonly class Price
{
    public function __construct(
        public Money $price,
    ) {
    }
}
