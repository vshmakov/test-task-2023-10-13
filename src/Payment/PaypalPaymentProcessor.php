<?php

declare(strict_types=1);

namespace App\Payment;

use App\Enums\PaymentProcessor;
use Money\Money;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor as SDKPaypalPaymentProcessor;

final readonly class PaypalPaymentProcessor implements PaymentProcessorInterface
{
    public function __construct(
        private SDKPaypalPaymentProcessor $paymentProcessor,
    ) {
    }

    public function getKey(): PaymentProcessor
    {
        return PaymentProcessor::PAYPAL;
    }

    public function supportsPayment(Money $money): bool
    {
        $price = (int) $money->getAmount();

        return $price <= 100000;
    }

    public function pay(Money $money): void
    {
        $this->paymentProcessor->pay(
            (int) $money->getAmount()
        );
    }
}
