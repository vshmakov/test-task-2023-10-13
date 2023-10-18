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
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor as SDKPaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor as SDKStripePaymentProcessor;
use Webmozart\Assert\Assert;

final readonly class StripePaymentProcessor implements PaymentProcessorInterface
{
    public function __construct(
        private SDKStripePaymentProcessor $paymentProcessor,
    )
    {
    }

    public function getKey(): PaymentProcessor
    {
        return PaymentProcessor::STRIPE;
    }

    public function pay(Money $money): void
    {
        $processed = $this->paymentProcessor->processPayment(
            MoneyHelper::eurToFloat($money)
        );

        if (!$processed) {
            throw new \RuntimeException('Payment is not processed');
        }
    }


}
