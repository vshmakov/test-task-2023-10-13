<?php

declare(strict_types=1);

namespace App\DTO;

use Money\Money;

final readonly class Price
{
    public float $amount;

    public function __construct(Money $price)
    {
        $this->amount = (float) $price->getAmount();
    }
}
