<?php

declare(strict_types=1);

namespace App\Payment;

use App\Enums\PaymentProcessor;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

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
            if ($key === $processor->getKey()) {
                return $processor;
            }
        }

        throw new \InvalidArgumentException(sprintf('Payment processor with %s key not found', $key));
    }
}
