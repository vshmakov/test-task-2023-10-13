<?php

declare(strict_types=1);

namespace App\Tests\Api\Purchase;

use App\DataFixtures\CouponFixtures;
use App\Entity\Product;
use App\Enums\HttpMethod;
use App\Tests\Api\ActionTest;
use Money\Money;

final class CalculatePriceTest extends ActionTest
{
    private Product $product;

    protected function prepareData(): void
    {
        $this->product = new Product();
        $this->product->setTitle('Test product');
        $this->product->setPrice(Money::EUR(100));

        $entityManager = $this->getEntityManager();
        $entityManager->persist($this->product);
        $entityManager->flush();
    }

    protected function getUrl(): string
    {
        return '/api/calculate-price';
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::POST;
    }

    protected function getBody(): ?array
    {
        return [
            'product' => $this->product->getId(),
            'taxNumber' => '123',
            'couponCode' => CouponFixtures::PERCENT_COUPON_CODE,
                    ];
    }

    protected function assertResult(): void
    {
        $data = $this->getJsonResponseData();
        $this->assertSame(94, $data['amount']);
    }
}
