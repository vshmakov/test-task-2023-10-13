<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApiResource\Order;
use App\DTO\Price;
use App\Payment\PriceCalculator;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final readonly class CalculatePriceAction
{
    public function __construct(
        private \ApiPlatform\Validator\ValidatorInterface $validator,
        private PriceCalculator $priceCalculator,
    ) {
    }

    public function __invoke(Order $order): Price
    {
        $this->validator->validate($order);

        return new Price(
            $this->priceCalculator->calculate($order)
        );
    }
}
