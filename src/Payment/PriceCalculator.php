<?php

declare(strict_types=1);

namespace App\Payment;

use App\ApiResource\BaseOrder;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Enums\CouponType;
use App\Money\MoneyHelper;
use App\Tax\TaxDefinitionInterface;
use App\Tax\TaxDefinitionProvider;
use Doctrine\ORM\EntityManagerInterface;
use Money\Money;
use Webmozart\Assert\Assert;

final readonly class PriceCalculator
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private TaxDefinitionProvider $taxDefinitionProvider,
    ) {
    }

    public function calculate(BaseOrder $order): Money
    {
        $product = $this->requireEntity(Product::class, $order->product);
        $taxDefinition = $this->taxDefinitionProvider->getTaxDefinition($order->taxNumber);
        Assert::notNull($taxDefinition);
        $coupon = null !== $order->couponCode ? $this->requireEntity(Coupon::class, $order->couponCode) : null;

        return $this->calculatePrice($product, $taxDefinition, $coupon);
    }

    private function requireEntity(string $entityClass, mixed $id): object
    {
        $entity = $this->entityManager->find($entityClass, $id);
        Assert::notNull($entity);

        return $entity;
    }

    private function calculatePrice(Product $product, TaxDefinitionInterface $taxDefinition, ?Coupon $coupon): Money
    {
        $price = $product->requirePrice();

        if (null !== $coupon) {
            $price = $this->applyCoupon($price, $coupon);
        }

        return $this->addTax($price, $taxDefinition);
    }

    private function applyCoupon(Money $price, Coupon $coupon): Money
    {
        $discount = match ($coupon->getType()) {
            CouponType::AMOUNT => $coupon->getAmount(),
            CouponType::PERCENT => MoneyHelper::calculatePercent($price, $coupon->getPercent()),
        };

        return $price->subtract($discount);
    }

    private function addTax(Money $price, TaxDefinitionInterface $taxDefinition): Money
    {
        return $price->add(
            MoneyHelper::calculatePercent($price, $taxDefinition->getValue())
        );
    }
}
