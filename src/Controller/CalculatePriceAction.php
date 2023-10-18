<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApiResource\Order;
use App\DTO\Price;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Enums\CouponType;
use App\Money\MoneyHelper;
use App\Payment\PriceCalculator;
use App\Tax\TaxDefinitionInterface;
use App\Tax\TaxDefinitionProvider;
use Doctrine\ORM\EntityManagerInterface;
use Money\Money;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Webmozart\Assert\Assert;

#[AsController]
final readonly class CalculatePriceAction
{
    public function __construct(
        private \ApiPlatform\Validator\ValidatorInterface $validator,
        private PriceCalculator                           $priceCalculator,
    )
    {
    }

    public function __invoke(Order $order): Price
    {
        $this->validator->validate($order);


        return new Price(
            $this->priceCalculator->calculate($order)
        );
    }
}
