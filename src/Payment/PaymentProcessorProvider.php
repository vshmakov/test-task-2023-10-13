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
use Webmozart\Assert\Assert;

final readonly class PaymentProcessorProvider
{
    public function __construct(
        /** @var iterable<PaymentProcessorInterface> */
        #[TaggedIterator(PaymentProcessorInterface::class)] private iterable $processors,
    ) {
    }


    public function requirePaymentProcessor(PaymentProcessor $key): PaymentProcessorInterface
    {
        foreach ($this->processors as $processor) {
            if ($key===$processor->getKey()){
                return  $processor;
            }
    }

        throw new \InvalidArgumentException(
            sprintf('Payment processor with %s key not found', $key)
        );
    }
}
