<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\ApiResource\Purchase;
use App\DTO\EmptyResponse;
use App\Payment\PaymentProcessorProvider;
use App\Payment\PriceCalculator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final readonly class PurchaseAction
{
    public function __construct(
        private ValidatorInterface $validator,
        private PriceCalculator $priceCalculator,
        private PaymentProcessorProvider $paymentProcessorProvider,
    ) {
    }

    public function __invoke(Purchase $purchase): EmptyResponse
    {
        $this->validator->validate($purchase);

        $paymentProcessor = $this->paymentProcessorProvider
            ->requirePaymentProcessor($purchase->paymentProcessor)
        ;
        $price = $this->priceCalculator->calculate($purchase);

        if (!$paymentProcessor->supportsPayment($price)) {
            throw new BadRequestException('Payment is not supported by the payment processor');
        }

        $paymentProcessor->pay($price);

        return new EmptyResponse();
    }
}
