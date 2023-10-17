<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use App\Entity\Product;
use App\Enums\PaymentProcessor;
use Doctrine\ORM\Mapping as ORM;

final class Order
{
    public ?Product $product = null;
    public ?string $taxNumber = null;
    public ?string $couponCode = null;
}
