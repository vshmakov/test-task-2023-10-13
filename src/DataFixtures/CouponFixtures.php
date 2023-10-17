<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Enums\CouponType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Money\Money;

final class CouponFixtures extends Fixture
{
    public const AMOUNT_COUPON_CODE = 'D12';
    public const PERCENT_COUPON_CODE = 'D15';

    public function load(ObjectManager $manager): void
    {
        $amountCoupon = new Coupon();
        $amountCoupon->setCode(self::AMOUNT_COUPON_CODE);
        $amountCoupon->setType(CouponType::AMOUNT);
        $amountCoupon->setAmount(Money::EUR(9));
        $manager->persist($amountCoupon);

        $percentCoupon = new Coupon();
        $percentCoupon->setCode(self::PERCENT_COUPON_CODE);
        $percentCoupon->setType(CouponType::PERCENT);
        $percentCoupon->setPercent(6.0);
        $manager->persist($percentCoupon);

        $manager->flush();
    }
}
