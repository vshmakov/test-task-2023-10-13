<?php

declare(strict_types=1);

namespace App\ApiResource;

final class Order
{
    public int $product;
    public string $taxNumber;
    public ?string $couponCode = null;
}
