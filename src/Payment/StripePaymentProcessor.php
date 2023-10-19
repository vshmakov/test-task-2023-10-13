<?php

declare(strict_types=1);

namespace App\Payment;

use App\Enums\PaymentProcessor;
use App\Money\MoneyHelper;
use Money\Money;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor as SDKStripePaymentProcessor;
use Webmozart\Assert\Assert;

final readonly class StripePaymentProcessor implements PaymentProcessorInterface
{
    public function __construct(
        private SDKStripePaymentProcessor $paymentProcessor,
    ) {
    }

    public function getKey(): PaymentProcessor
    {
        return PaymentProcessor::STRIPE;
    }

    public function supportsPayment(Money $money): bool
    {
        return MoneyHelper::eurToFloat($money) >= 100.0;
    }

    public function pay(Money $money): void
    {
        $processed = $this->paymentProcessor->processPayment(
            MoneyHelper::eurToFloat($money)
        );
        Assert::true($processed, 'The payment could not be processed');
    }
}
