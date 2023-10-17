<?php

declare(strict_types=1);

namespace App\ApiResource;

use App\Entity\Product;
use App\Enums\PaymentProcessor;

final class Purchase
{
    public ?Product $product = null;
    public ?string $taxNumber = null;
    public ?string $couponCode = null;
    public ?PaymentProcessor $paymentProcessor = null;
}
