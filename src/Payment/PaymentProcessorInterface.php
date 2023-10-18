<?php

declare(strict_types=1);

namespace App\Payment;

use App\ApiResource\BaseOrder;
use App\ApiResource\Order;
use App\DTO\Price;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Enums\CouponType;
use App\Enums\PaymentProcessor;
use App\Money\MoneyHelper;
use App\Tax\TaxDefinitionInterface;
use App\Tax\TaxDefinitionProvider;
use Doctrine\ORM\EntityManagerInterface;
use Money\Money;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Webmozart\Assert\Assert;

#[AutoconfigureTag(PaymentProcessorInterface::class)]
interface PaymentProcessorInterface
{
    public function getKey(): PaymentProcessor;

    public function pay(Money $money): void;
}
