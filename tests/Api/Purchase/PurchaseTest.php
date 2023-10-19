<?php

declare(strict_types=1);

namespace App\Tests\Api\Purchase;

use App\DataFixtures\CouponFixtures;
use App\Entity\Product;
use App\Enums\HttpMethod;
use App\Enums\PaymentProcessor;
use App\Money\MoneyHelper;
use App\Tests\Api\ActionTest;

final class PurchaseTest extends ActionTest
{
    private Product $product;

    protected function prepareData(): void
    {
        $this->product = new Product();
        $this->product->setTitle('Test product');
        $this->product->setPrice(MoneyHelper::floatToEur(100.0));

        $entityManager = $this->getEntityManager();
        $entityManager->persist($this->product);
        $entityManager->flush();
    }

    protected function getUrl(): string
    {
        return '/api/purchase';
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::POST;
    }

    protected function getBody(): ?array
    {
        return [
            'product' => $this->product->getId(),
            'taxNumber' => 'GR123456789',
            'couponCode' => CouponFixtures::AMOUNT_COUPON_CODE,
            'paymentProcessor' => PaymentProcessor::PAYPAL->value,
        ];
    }
}
