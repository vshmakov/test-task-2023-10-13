<?php

declare(strict_types=1);

namespace App\Payment;

use App\Enums\PaymentProcessor;
use Money\Money;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(PaymentProcessorInterface::class)]
interface PaymentProcessorInterface
{
    public function getKey(): PaymentProcessor;

    public function pay(Money $money): void;
}
