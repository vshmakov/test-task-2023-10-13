<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\ApiResource\Purchase;
use App\Enums\HttpMethod;
use App\Payment\PaymentProcessorProvider;
use App\Payment\PriceCalculator;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/purchase', methods: HttpMethod::POST->name)]
final readonly class PurchaseAction
{
    public function __construct(
        private ValidatorInterface $validator,
        private PriceCalculator $priceCalculator,
        private PaymentProcessorProvider $paymentProcessorProvider,
    ) {
    }

    public function __invoke(Purchase $purchase): Purchase
    {
        $price = $this->priceCalculator->calculate($purchase);
        $this->paymentProcessorProvider
            ->requirePaymentProcessor($purchase->paymentProcessor)
            ->pay($price)
        ;

        return $purchase;
    }
}
