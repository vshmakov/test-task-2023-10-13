<?php

declare(strict_types=1);

namespace App\ApiResource;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Validator\EntityId;
use App\Validator\TaxNumber;

final class Order
{
    #[EntityId(entityClass: Product::class)]
    public int $product;

    #[TaxNumber]
    public string $taxNumber;

    #[EntityId(entityClass: Coupon::class)]
    public ?string $couponCode = null;
}
