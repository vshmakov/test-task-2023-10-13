<?php

declare(strict_types=1);

namespace App\ApiResource;

use App\Enums\PaymentProcessor;

final class Purchase extends BaseOrder
{
    public PaymentProcessor $paymentProcessor;
}
