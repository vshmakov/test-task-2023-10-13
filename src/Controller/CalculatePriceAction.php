<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApiResource\Order;
use App\DTO\Price;
use App\Repository\ProductRepository;
use Money\Money;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final readonly class CalculatePriceAction
{
    public function __construct(
        private \ApiPlatform\Validator\ValidatorInterface $validator,
        private ProductRepository $productRepository,
    ) {
    }

    public function __invoke(Order $order): Price
    {
        $this->validator->validate($order);

        $product = $this->productRepository->find($order->product);

        if (null === $product) {
            throw new BadRequestHttpException('Invalid product');
        }

        return new Price(
            Money::EUR(152)
        );
    }
}
