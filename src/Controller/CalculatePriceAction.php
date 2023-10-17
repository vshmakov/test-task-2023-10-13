<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApiResource\Order;
use App\DTO\Price;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Enums\CouponType;
use Doctrine\ORM\EntityManagerInterface;
use Money\Money;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Webmozart\Assert\Assert;

#[AsController]
final readonly class CalculatePriceAction
{
    public function __construct(
        private \ApiPlatform\Validator\ValidatorInterface $validator,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(Order $order): Price
    {
        $this->validator->validate($order);

        $product = $this->requireEntity(Product::class, $order->product);
        $coupon = null !== $order->couponCode ? $this->requireEntity(Coupon::class, $order->couponCode) : null;

        return new Price(
            $this->calculatePrice($product, $coupon)
        );
    }

    private function requireEntity(string $entityClass, mixed $id): object
    {
        $entity = $this->entityManager->find($entityClass, $id);
        Assert::notNull($entity);

        return $entity;
    }

    private function calculatePrice(Product $product, ?Coupon $coupon): Money
    {
        $price = $product->requirePrice();

        if (null !== $coupon) {
            $price = $this->applyCoupon($price, $coupon);
        }

        return $price;
    }

    private function applyCoupon(Money $price, Coupon $coupon): Money
    {
        return match ($coupon->getType()) {
            CouponType::AMOUNT => $price->subtract($coupon->getAmount()),
            CouponType::PERCENT => $price->multiply(
                (100.00 - $coupon->getPercent()) / 100
            ),
        };
    }
}
